<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta Gantt del Proyecto de Investigación</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            flex-direction: column;
        }
        .container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 1400px;
            width: 100%;
        }
        .instructions {
            font-size: 0.9rem;
            color: #555;
            background-color: #e9ecef;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            text-align: center;
        }
        /* Estilos para el SVG */
        .gantt-chart .grid-line {
            stroke: #e0e0e0;
            stroke-width: 1;
            shape-rendering: crispEdges;
        }
        .gantt-chart .month-label {
            font-size: 12px;
            fill: #666;
        }
        .gantt-chart .year-label {
            font-size: 16px;
            font-weight: 600;
            fill: #333;
        }
        .gantt-chart .task-label {
            font-size: 14px;
            fill: #343a40;
        }
        .gantt-chart .section-label {
            font-size: 16px;
            font-weight: 700;
            fill: #005a9c;
        }
        .gantt-chart .task-bar {
            stroke-width: 0;
            rx: 6;
            ry: 6;
            transition: opacity 0.2s ease-in-out;
        }
        .gantt-chart .task-bar:hover {
            opacity: 0.8;
        }
        .gantt-chart .status-default { fill: #6c757d; }
        .gantt-chart .status-done { fill: #28a745; }
        .gantt-chart .status-active { fill: #007bff; }
        .gantt-chart .milestone {
            fill: #fd7e14;
            stroke: #fff;
            stroke-width: 2;
        }
        .gantt-chart .today-line {
            stroke: #dc3545;
            stroke-width: 2;
            stroke-dasharray: 6 4;
        }
        .gantt-chart .today-label {
            fill: #dc3545;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Contenedor del SVG para la carta Gantt -->
    <svg id="gantt-chart" class="gantt-chart" width="100%" viewBox="0 0 1500 1100" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="grad-done" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:#28a745;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#218838;stop-opacity:1" />
            </linearGradient>
            <linearGradient id="grad-active" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:#007bff;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#0056b3;stop-opacity:1" />
            </linearGradient>
            <linearGradient id="grad-default" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:#6c757d;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#5a6268;stop-opacity:1" />
            </linearGradient>
        </defs>
        
        <!-- Título del Gráfico -->
        <text x="750" y="40" font-size="24" font-weight="bold" text-anchor="middle">Cronograma del Proyecto de Investigación</text>

        <!-- Script para generar el gráfico dinámicamente -->
        <script type="text/javascript">
            // Configuración del gráfico
            const chart = document.getElementById('gantt-chart');
            const tasks = [
                { phase: 'Fase 1: Planificación y Aprobación', name: 'Diseño y Redacción del Protocolo', start: '2025-08', duration: 2, status: 'active' },
                { phase: 'Fase 1: Planificación y Aprobación', name: 'Aprob. Comité U. Chile', start: '2025-10', duration: 2, status: 'default' },
                { phase: 'Fase 1: Planificación y Aprobación', name: 'Aprob. Comisión HCSBA', start: '2025-12', duration: 2, status: 'default' },
                { phase: 'Fase 1: Planificación y Aprobación', name: 'Aprob. Final Comité Ética SSMC', start: '2026-02', duration: 2, status: 'default' },
                { phase: 'Fase 1: Planificación y Aprobación', name: 'Preparación Logística y de Campo', start: '2026-04', duration: 1, status: 'default' },
                
                { phase: 'Fase 2: Ejecución (Trabajo de Campo)', name: 'Reclutamiento y Consentimiento', start: '2026-04', duration: 8, status: 'default' },
                { phase: 'Fase 2: Ejecución (Trabajo de Campo)', name: 'Recolección de Datos', start: '2026-04', duration: 8, status: 'default' },
                { phase: 'Fase 2: Ejecución (Trabajo de Campo)', name: 'Cierre y Análisis Preliminar', start: '2026-11', duration: 1, status: 'default' },

                { phase: 'Fase 3: Análisis y Redacción', name: 'Depuración Base de Datos', start: '2026-12', duration: 1, status: 'default' },
                { phase: 'Fase 3: Análisis y Redacción', name: 'Análisis Estadístico Formal', start: '2027-01', duration: 1, status: 'default' },
                { phase: 'Fase 3: Análisis y Redacción', name: 'Interpretación y Conclusiones', start: '2027-02', duration: 2, status: 'default' },
                { phase: 'Fase 3: Análisis y Redacción', name: 'Redacción Borrador Manuscrito', start: '2027-03', duration: 7, status: 'default' },
                { phase: 'Fase 3: Análisis y Redacción', name: 'Revisión con Tutor (Abril)', start: '2027-04', duration: 1, status: 'default' },
                { phase: 'Fase 3: Análisis y Redacción', name: 'Revisión con Tutor (Junio)', start: '2027-06', duration: 1, status: 'default' },
                { phase: 'Fase 3: Análisis y Redacción', name: 'Revisión con Tutor (Septiembre)', start: '2027-09', duration: 1, status: 'default' },
                
                { phase: 'Fase 4: Difusión', name: 'Sometimiento a Revista', start: '2027-10', duration: 3, status: 'default' },
                { phase: 'Fase 4: Difusión', name: 'Publicación de resultados', start: '2028-01', duration: 1, status: 'default' }
            ];

            const chartWidth = 1500;
            const chartHeight = 1100;
            const leftPadding = 300;
            const topPadding = 80;
            const gridWidth = chartWidth - leftPadding - 50;
            const rowHeight = 40;
            const barHeight = 20;

            const startDate = new Date('2025-08-01');
            const endDate = new Date('2028-02-28'); // Corrected end date to tighten the timeline

            const totalMonths = (endDate.getFullYear() - startDate.getFullYear()) * 12 + (endDate.getMonth() - startDate.getMonth()) + 1;
            const monthWidth = gridWidth / totalMonths;

            // Función para obtener el índice del mes
            function getMonthIndex(dateStr) {
                const date = new Date(dateStr + '-01');
                return (date.getFullYear() - startDate.getFullYear()) * 12 + (date.getMonth() - startDate.getMonth());
            }

            // Dibujar Eje de Tiempo y Cuadrícula
            const axisGroup = document.createElementNS('http://www.w3.org/2000/svg', 'g');
            let currentYear = -1;
            for (let i = 0; i < totalMonths; i++) {
                const year = startDate.getFullYear() + Math.floor((startDate.getMonth() + i) / 12);
                const month = (startDate.getMonth() + i) % 12;
                const monthDate = new Date(year, month, 1);
                
                const x = leftPadding + i * monthWidth;

                // Líneas de la cuadrícula vertical
                const gridLine = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                gridLine.setAttribute('x1', x);
                gridLine.setAttribute('y1', topPadding);
                gridLine.setAttribute('x2', x);
                gridLine.setAttribute('y2', chartHeight - 50);
                gridLine.setAttribute('class', 'grid-line');
                axisGroup.appendChild(gridLine);

                // Etiquetas de los meses
                const monthLabel = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                monthLabel.setAttribute('x', x + monthWidth / 2);
                monthLabel.setAttribute('y', topPadding + 20);
                monthLabel.setAttribute('text-anchor', 'middle');
                monthLabel.setAttribute('class', 'month-label');
                monthLabel.textContent = monthDate.toLocaleDateString('es-ES', { month: 'short' });
                axisGroup.appendChild(monthLabel);

                // Etiquetas de los años
                if (monthDate.getFullYear() !== currentYear) {
                    currentYear = monthDate.getFullYear();
                    const yearLabel = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                    yearLabel.setAttribute('x', x);
                    yearLabel.setAttribute('y', topPadding - 5);
                    yearLabel.setAttribute('text-anchor', 'start');
                    yearLabel.setAttribute('class', 'year-label');
                    yearLabel.textContent = currentYear;
                    axisGroup.appendChild(yearLabel);
                }
            }
            chart.appendChild(axisGroup);
            
            // Dibujar Tareas
            const tasksGroup = document.createElementNS('http://www.w3.org/2000/svg', 'g');
            let currentY = topPadding + 60;
            let currentPhase = '';

            tasks.forEach(task => {
                // Título de la fase
                if (task.phase !== currentPhase) {
                    currentPhase = task.phase;
                    // Add a new section for Fase 4: Difusión
                    if (task.phase === 'Fase 4: Difusión' && currentPhase !== 'Fase 3: Análisis y Redacción') {
                         currentY += rowHeight * 0.8; 
                         const phaseLabel = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                         phaseLabel.setAttribute('x', 20);
                         phaseLabel.setAttribute('y', currentY + barHeight / 2 + 5);
                         phaseLabel.setAttribute('class', 'section-label');
                         phaseLabel.textContent = currentPhase;
                         tasksGroup.appendChild(phaseLabel);
                         currentY += rowHeight;
                    } else if (currentPhase !== '') {
                        currentY += rowHeight * 0.8; // Espacio extra antes de una nueva fase
                        const phaseLabel = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                        phaseLabel.setAttribute('x', 20);
                        phaseLabel.setAttribute('y', currentY + barHeight / 2 + 5);
                        phaseLabel.setAttribute('class', 'section-label');
                        phaseLabel.textContent = task.phase;
                        tasksGroup.appendChild(phaseLabel);
                        currentY += rowHeight;
                    }
                }

                // Etiqueta de la tarea
                const taskLabel = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                taskLabel.setAttribute('x', 30);
                taskLabel.setAttribute('y', currentY + barHeight / 2 + 5);
                taskLabel.setAttribute('class', 'task-label');
                taskLabel.textContent = task.name;
                tasksGroup.appendChild(taskLabel);

                const monthIndex = getMonthIndex(task.start);
                const x = leftPadding + monthIndex * monthWidth;
                
                // Dibujar hito o barra de tarea
                if (task.status === 'milestone') {
                    const milestoneSize = 12;
                    const milestone = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
                    const milestoneX = x + (monthWidth / 2) - milestoneSize;
                    const milestoneY = currentY + (barHeight / 2) - milestoneSize;
                    milestone.setAttribute('x', milestoneX);
                    milestone.setAttribute('y', milestoneY);
                    milestone.setAttribute('width', milestoneSize * 2);
                    milestone.setAttribute('height', milestoneSize * 2);
                    milestone.setAttribute('class', 'milestone');
                    milestone.setAttribute('transform', `rotate(45, ${milestoneX + milestoneSize}, ${milestoneY + milestoneSize})`);
                    tasksGroup.appendChild(milestone);
                } else {
                    const barWidth = task.duration * monthWidth;
                    const taskBar = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
                    taskBar.setAttribute('x', x);
                    taskBar.setAttribute('y', currentY);
                    taskBar.setAttribute('width', barWidth);
                    taskBar.setAttribute('height', barHeight);
                    
                    let fillStyle = 'url(#grad-default)';
                    if(task.status === 'done') fillStyle = 'url(#grad-done)';
                    if(task.status === 'active') fillStyle = 'url(#grad-active)';
                    taskBar.setAttribute('fill', fillStyle);
                    
                    taskBar.setAttribute('class', 'task-bar');
                    tasksGroup.appendChild(taskBar);
                }
                
                currentY += rowHeight;
            });
            chart.appendChild(tasksGroup);

            // Dibujar línea de "Hoy"
            const today = new Date();
            if (today >= startDate && today <= endDate) {
                const todayIndex = (today.getFullYear() - startDate.getFullYear()) * 12 + (today.getMonth() - startDate.getMonth()) + (today.getDate() / 30.44); // Aproximación
                const todayX = leftPadding + todayIndex * monthWidth;

                const todayLine = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                todayLine.setAttribute('x1', todayX);
                todayLine.setAttribute('y1', topPadding);
                todayLine.setAttribute('x2', todayX);
                todayLine.setAttribute('y2', currentY - rowHeight/2);
                todayLine.setAttribute('class', 'today-line');
                chart.appendChild(todayLine);

                const todayLabel = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                todayLabel.setAttribute('x', todayX);
                todayLabel.setAttribute('y', topPadding - 10);
                todayLabel.setAttribute('text-anchor', 'middle');
                todayLabel.setAttribute('class', 'today-label');
                todayLabel.textContent = 'Hoy';
                chart.appendChild(todayLabel);
            }
        </script>
    </svg>
</div>

</body>
</html>

