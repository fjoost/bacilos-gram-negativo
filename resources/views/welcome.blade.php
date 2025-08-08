<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resistencia en Bacilos Gram Negativos: Guía Interactiva</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Chosen Palette: Warm Neutrals with Teal/Blue Accent -->
    <!-- Application Structure Plan: A single-page application with a top navigation bar for thematic exploration (Inicio, El Adversario, Mecanismos, Arsenal Enzimático). This non-linear structure allows users to either follow a guided path or jump directly to topics of interest. The core is an interactive bacterium diagram in the 'Mecanismos' section, linking visual components to detailed explanations, fostering engaged learning over passive reading. The 'Arsenal Enzimático' section uses a dynamic chart for direct comparison of enzyme efficacy, making complex data easily digestible. This design prioritizes user-driven exploration and contextual understanding over a rigid slide-by-slide format. -->
    <!-- Visualization & Content Choices: 
        - WHO Priority List: (Goal: Inform) -> Structured HTML list for clarity and accessibility.
        - BGN Structure: (Goal: Organize/Inform) -> Interactive diagram using HTML/Tailwind. User clicks on parts of the cell (porin, pump, etc.) to reveal info. Justification: Connects abstract mechanisms to physical locations, enhancing memory and comprehension. Method: HTML, CSS, JS.
        - Beta-Lactamase Comparison: (Goal: Compare) -> Dynamic Bar Chart. Compares hydrolytic activity of ESBL, AmpC, and Carbapenemases. Justification: A chart provides a much clearer and more immediate comparison of potency than a text table. Library: Chart.js.
        - All content is presented within clear contextual sections, each with an introductory paragraph explaining its purpose and content.
    -->
    <!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .chart-container { position: relative; width: 100%; max-width: 700px; margin-left: auto; margin-right: auto; height: 350px; max-height: 50vh; }
        @media (min-width: 768px) { .chart-container { height: 450px; } }
        .nav-link { transition: color 0.3s, border-bottom-color 0.3s; }
        .active-link { color: #0891b2; border-bottom-color: #0891b2; }
        .inactive-link { color: #4b5563; border-bottom-color: transparent; }
        .bacterium-hotspot { transition: transform 0.2s, filter 0.2s; cursor: pointer; }
        .bacterium-hotspot:hover { transform: scale(1.1); filter: drop-shadow(0 0 8px #0891b2); }
        .content-section { display: none; }
        .active-section { display: block; }
    </style>
</head>
<body class="text-gray-800">

    <header class="bg-white/80 backdrop-blur-lg sticky top-0 z-50 shadow-md">
        <nav class="container mx-auto px-6 py-4">
            <ul class="flex justify-center space-x-6 md:space-x-10 text-lg">
                <li><a href="#inicio" class="nav-link font-semibold pb-1 border-b-2">Inicio</a></li>
                <li><a href="#adversario" class="nav-link font-semibold pb-1 border-b-2">El Adversario</a></li>
                <li><a href="#mecanismos" class="nav-link font-semibold pb-1 border-b-2">Mecanismos</a></li>
                <li><a href="#arsenal" class="nav-link font-semibold pb-1 border-b-2">Arsenal Enzimático</a></li>
            </ul>
        </nav>
    </header>

    <main class="container mx-auto p-6 md:p-10">
        <section id="inicio" class="content-section min-h-screen text-center flex flex-col justify-center">
            <h1 class="text-4xl md:text-6xl font-bold text-cyan-700 mb-4">La Amenaza Invisible</h1>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto">Una guía interactiva sobre los mecanismos de resistencia de los Bacilos Gram Negativos, los patógenos que desafían la medicina moderna.</p>
            <p class="mt-8 text-lg">Navega por las secciones para explorar cómo estas bacterias se defienden de los antibióticos.</p>
        </section>

        <section id="adversario" class="content-section min-h-screen">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-4">Conociendo al Adversario</h2>
                <p class="text-lg text-center text-gray-600 mb-12">Para entender la resistencia, primero debemos conocer la estructura única del Bacilo Gram Negativo (BGN). Su principal característica es una doble membrana que actúa como una formidable barrera defensiva, complicando el acceso de los antibióticos a sus objetivos internos.</p>
                <div class="bg-white p-8 rounded-xl shadow-lg flex flex-col md:flex-row items-center gap-8">
                    <div class="w-full md:w-1/2 space-y-4">
                        <div class="p-4 bg-cyan-50 rounded-lg">
                            <h3 class="font-bold text-xl text-cyan-800">Membrana Externa</h3>
                            <p>Una capa lipídica extra que contiene lipopolisacáridos (LPS) y actúa como un escudo, impidiendo la entrada de muchos fármacos.</p>
                        </div>
                        <div class="p-4 bg-cyan-50 rounded-lg">
                            <h3 class="font-bold text-xl text-cyan-800">Porinas</h3>
                            <p>Canales proteicos que atraviesan la membrana externa. Son las "puertas" de entrada para nutrientes y, crucialmente, para algunos antibióticos hidrofílicos.</p>
                        </div>
                         <div class="p-4 bg-cyan-50 rounded-lg">
                            <h3 class="font-bold text-xl text-cyan-800">Espacio Periplásmico</h3>
                            <p>La "zona de combate" entre las dos membranas. Aquí se concentran muchas de las enzimas que destruyen antibióticos, como las β-lactamasas.</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 flex justify-center items-center">
                        <div class="relative w-64 h-64">
                            <div class="absolute inset-0 bg-red-200 rounded-full opacity-30"></div>
                            <div class="absolute inset-4 bg-yellow-200 rounded-full opacity-50"></div>
                            <div class="absolute inset-8 bg-gray-700 rounded-full flex justify-center items-center text-white p-4 text-center">Citoplasma</div>
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-48 h-48 border-2 border-dashed border-yellow-600 rounded-full flex items-center justify-center">
                                <span class="text-sm text-yellow-800 font-semibold -rotate-45">Espacio Periplásmico</span>
                            </div>
                             <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 border-2 border-dashed border-red-600 rounded-full flex items-center justify-center">
                                <span class="text-sm text-red-800 font-semibold rotate-45 absolute -top-2">Membrana Externa</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="mecanismos" class="content-section min-h-screen">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4">Mecanismos de Defensa</h2>
            <p class="text-lg text-center text-gray-600 mb-12 max-w-4xl mx-auto">Los BGN han desarrollado un sofisticado arsenal de estrategias para sobrevivir a los antibióticos. Haz clic en los puntos interactivos del diagrama para explorar los cuatro mecanismos principales.</p>
            <div class="flex flex-col lg:flex-row items-center justify-center gap-8">
                <div class="relative w-80 h-48 bg-cyan-800 rounded-3xl p-2 shadow-2xl">
                    <div class="w-full h-full bg-cyan-100 rounded-2xl flex items-center justify-around p-4">
                        <div id="hotspot-porin" class="bacterium-hotspot w-8 h-16 bg-orange-500 rounded-lg border-2 border-orange-700" title="1. Bloquear la Entrada (Porinas)"></div>
                        <div id="hotspot-pump" class="bacterium-hotspot w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-2xl" title="2. Expulsar al Invasor (Bombas)">→</div>
                        <div id="hotspot-enzyme" class="bacterium-hotspot w-10 h-10 bg-purple-500 rounded-xl transform rotate-45" title="3. Desactivar el Arma (Enzimas)"></div>
                        <div id="hotspot-target" class="bacterium-hotspot w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white" title="4. Camuflar el Objetivo">🎯</div>
                    </div>
                </div>
                <div id="mechanism-info" class="w-full lg:w-1/2 min-h-[20rem] bg-white p-8 rounded-xl shadow-lg">
                    <h3 id="info-title" class="text-2xl font-bold text-cyan-700 mb-4">Selecciona un mecanismo</h3>
                    <p id="info-text" class="text-lg text-gray-700">Haz clic en uno de los íconos de la bacteria para ver los detalles de su estrategia de resistencia.</p>
                </div>
            </div>
        </section>

        <section id="arsenal" class="content-section min-h-screen">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4">Arsenal Enzimático: Las β-Lactamasas</h2>
            <p class="text-lg text-center text-gray-600 mb-12 max-w-4xl mx-auto">La inactivación enzimática es la estrategia de resistencia más importante contra los antibióticos β-lactámicos. Estas enzimas, llamadas β-lactamasas, actúan como "tijeras moleculares". El siguiente gráfico compara el poder destructivo de las familias más relevantes: BLEE, AmpC y Carbapenemasas.</p>
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="chart-container">
                    <canvas id="enzymeChart"></canvas>
                </div>
            </div>
        </section>
    </main>
    
    <script>
        const mechanismData = {
            'hotspot-porin': {
                title: '1. Bloqueo de Entrada: Alteración de Porinas',
                text: 'Las bacterias reducen la permeabilidad de su membrana externa al modificar o eliminar los canales de porinas. Si el antibiótico no puede entrar, no puede actuar. Este es un mecanismo clave de resistencia contra carbapenémicos en patógenos como <i>Pseudomonas aeruginosa</i>.'
            },
            'hotspot-pump': {
                title: '2. Expulsión Activa: Bombas de Eflujo',
                text: 'Estos sistemas proteicos actúan como catapultas moleculares, reconociendo y expulsando activamente los antibióticos fuera de la célula antes de que alcancen su objetivo. Confieren resistencia a múltiples clases de fármacos, como quinolonas y tetraciclinas.'
            },
            'hotspot-enzyme': {
                title: '3. Inactivación Enzimática: β-Lactamasas',
                text: 'Es el mecanismo más común contra los β-lactámicos. Las bacterias producen enzimas que hidrolizan (rompen) el anillo β-lactámico, la estructura esencial del antibiótico, desactivándolo por completo. Existen cientos de variantes con diferente poder.'
            },
            'hotspot-target': {
                title: '4. Modificación del Objetivo',
                text: 'La bacteria altera el sitio celular donde el antibiótico normalmente se une. Por ejemplo, mutaciones en la ADN girasa confieren resistencia a las quinolonas. Es como cambiar la cerradura para que la llave del antibiótico ya no encaje.'
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('.content-section');
            const infoTitle = document.getElementById('info-title');
            const infoText = document.getElementById('info-text');

            function updateActiveLink() {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (window.scrollY >= sectionTop - 100) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active-link');
                    link.classList.add('inactive-link');
                    if (link.getAttribute('href') === `#${current}`) {
                        link.classList.add('active-link');
                        link.classList.remove('inactive-link');
                    }
                });
            }
            
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    document.querySelector(link.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
                });
            });

            window.addEventListener('scroll', updateActiveLink);
            updateActiveLink();

            document.querySelectorAll('.bacterium-hotspot').forEach(hotspot => {
                hotspot.addEventListener('click', () => {
                    const data = mechanismData[hotspot.id];
                    infoTitle.textContent = data.title;
                    infoText.innerHTML = data.text;
                });
            });

            const ctx = document.getElementById('enzymeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Penicilinas', 'Cefalosporinas (1-3G)', 'Cefalosporinas (4G)', 'Carbapenémicos'],
                    datasets: [{
                        label: 'BLEE',
                        data: [100, 100, 80, 0],
                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1
                    }, {
                        label: 'AmpC',
                        data: [100, 100, 50, 0],
                        backgroundColor: 'rgba(239, 68, 68, 0.7)',
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Carbapenemasas',
                        data: [100, 100, 100, 100],
                        backgroundColor: 'rgba(139, 92, 246, 0.7)',
                        borderColor: 'rgba(139, 92, 246, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Espectro de Hidrólisis de β-Lactamasas Clave',
                            font: { size: 18 },
                            padding: { top: 10, bottom: 20 }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += `${context.parsed.y}% de actividad hidrolítica`;
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 110,
                            title: {
                                display: true,
                                text: 'Actividad Hidrolítica (%)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value + '%'
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Clase de Antibiótico β-Lactámico'
                            }
                        }
                    }
                }
            });
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const id = entry.target.getAttribute('id');
                    const navLink = document.querySelector(`nav a[href="#${id}"]`);
                    if (entry.isIntersecting) {
                        navLinks.forEach(link => link.classList.remove('active-link'));
                        navLink.classList.add('active-link');
                    }
                });
            }, { rootMargin: "-50% 0px -50% 0px" });

            sections.forEach(section => {
                observer.observe(section);
            });

            function showInitialSection() {
                const hash = window.location.hash || '#inicio';
                document.querySelectorAll('.content-section').forEach(s => s.style.display = 'none');
                const targetSection = document.querySelector(hash);
                if (targetSection) {
                    targetSection.style.display = 'block';
                    targetSection.scrollIntoView();
                } else {
                    document.querySelector('#inicio').style.display = 'block';
                }
                updateActiveLink();
            }

            // Simplified navigation logic for SPA feel
            navLinks.forEach(link => {
                link.addEventListener('click', e => {
                    e.preventDefault();
                    const targetId = link.getAttribute('href');
                    history.pushState(null, '', targetId);
                    document.querySelectorAll('.content-section').forEach(s => s.style.display = 'none');
                    document.querySelector(targetId).style.display = 'block';
                    updateActiveLink();
                });
            });
            
            // Show the first section on load
            document.querySelector('#inicio').style.display = 'block';

        });
    </script>
</body>
</html>
