<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronograma del Proyecto de Investigación</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fa;
        }
        /* Custom scrollbar for better aesthetics */
        .gantt-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .gantt-container::-webkit-scrollbar-track {
            background: #e0e7ff;
            border-radius: 10px;
        }
        .gantt-container::-webkit-scrollbar-thumb {
            background: #4f46e5;
            border-radius: 10px;
        }
        .gantt-container::-webkit-scrollbar-thumb:hover {
            background: #4338ca;
        }
        .milestone-diamond {
            width: 20px;
            height: 20px;
            transform: rotate(45deg);
        }
    </style>
</head>
<body class="bg-gray-100 p-4 sm:p-6 md:p-8">
    <div id="capture-area" class="max-w-7xl mx-auto bg-white rounded-2xl shadow-lg p-6 md:p-8 overflow-hidden">
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Cronograma del Proyecto de Investigación</h1>
            <p class="text-gray-500 mt-1">Duración total estimada: 43 meses (Junio 2025 - Diciembre 2028)</p>
        </div>

        <div class="flex items-center justify-end space-x-4 mb-4 text-sm">
             <div class="flex items-center"><span class="h-4 w-4 rounded-full bg-emerald-500 mr-2"></span>Completado</div>
             <div class="flex items-center"><span class="h-4 w-4 rounded-full bg-indigo-500 mr-2"></span>En Progreso</div>
             <div class="flex items-center"><span class="h-4 w-4 rounded-full bg-gray-300 mr-2"></span>Pendiente</div>
             <div class="flex items-center"><span class="h-3 w-3 milestone-diamond bg-red-500 mr-3 ml-1"></span>Hito Clave</div>
        </div>

        <div id="gantt-chart" class="gantt-container overflow-x-auto">
            <!-- El gráfico se generará aquí con JavaScript -->
        </div>

        <div class="mt-6 text-center text-gray-500 text-sm">
            <p>💡 Para exportar, ajuste el tamaño de la ventana y tome una captura de pantalla de esta área.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const projectData = {
                startDate: '2025-06-01',
                endDate: '2028-12-31',
                phases: [
                    {
                        name: 'Fase 1: Planificación y Aprobación',
                        tasks: [
                            { name: 'Diseño del protocolo', start: '2025-06', months: 3, status: 'done' },
                            { name: 'Envío a Comité Ético (U. Chile)', start: '2025-09', months: 1, status: 'pending' },
                            { name: 'Envío a Comité Investigación (HCSBA)', start: '2025-10', months: 1, status: 'pending' },
                            { name: 'Envío a Comité Ética (SSMC)', start: '2025-11', months: 1, status: 'pending' },
                            { name: 'Recepción y Aprobaciones Finales', start: '2025-12', months: 3, status: 'pending' },
                            { name: 'Preparación para inicio del proyecto', start: '2026-03', months: 2, status: 'pending' },
                        ]
                    },
                    {
                        name: 'Fase 2: Ejecución y Recolección de Datos',
                        tasks: [
                            { name: 'Reclutamiento y recolección de datos', start: '2026-05', months: 7, status: 'active' },
                            { name: 'Análisis preliminar de los datos', start: '2026-08', months: 0, status: 'milestone' },
                        ]
                    },
                    {
                        name: 'Fase 3: Análisis y Redacción',
                        tasks: [
                            { name: 'Redacción de resultados y discusión', start: '2026-12', months: 3, status: 'pending' },
                            { name: 'Revisión final junto al tutor', start: '2027-03', months: 1, status: 'pending' },
                        ]
                    },
                    {
                        name: 'Fase 4: Difusión',
                        tasks: [
                            { name: 'Presentación final y publicación', start: '2027-04', months: 21, status: 'pending' },
                        ]
                    }
                ]
            };

            const ganttChart = document.getElementById('gantt-chart');
            const today = new Date('2025-08-26'); // Fecha de referencia estática para visualización

            const start = new Date(projectData.startDate);
            const end = new Date(projectData.endDate);

            let months = [];
            let currentDate = new Date(start);
            while (currentDate <= end) {
                months.push(new Date(currentDate));
                currentDate.setMonth(currentDate.getMonth() + 1);
            }

            const totalMonths = months.length;
            const taskColumnWidth = '280px';
            const monthColumnWidth = '80px';
            const totalWidth = `calc(${taskColumnWidth} + ${totalMonths} * ${monthColumnWidth})`;
            
            ganttChart.style.minWidth = totalWidth;

            // Crear el contenedor de la grilla
            const gridContainer = document.createElement('div');
            gridContainer.className = 'relative grid';
            gridContainer.style.gridTemplateColumns = `${taskColumnWidth} repeat(${totalMonths}, ${monthColumnWidth})`;
            
            // --- Generar Cabecera de Años y Meses ---
            let years = {};
            months.forEach((month, i) => {
                const year = month.getFullYear();
                if (!years[year]) {
                    years[year] = { start: i + 2, count: 0 };
                }
                years[year].count++;
            });

            // Fila de Años
            const yearHeader = document.createElement('div');
            yearHeader.className = 'sticky top-0 z-20 col-span-1 bg-white border-b-2 border-indigo-200 grid-cell font-semibold text-gray-600 text-sm';
            gridContainer.appendChild(yearHeader);

            for (const year in years) {
                const yearCell = document.createElement('div');
                yearCell.className = 'text-center py-2 border-r border-gray-200';
                yearCell.innerText = year;
                yearCell.style.gridColumn = `${years[year].start} / span ${years[year].count}`;
                gridContainer.appendChild(yearCell);
            }

            // Fila de Meses
            const monthHeader = document.createElement('div');
            monthHeader.className = 'sticky top-10 z-20 col-span-1 bg-white border-b border-gray-200 grid-cell font-semibold text-gray-600 text-sm';
            gridContainer.appendChild(monthHeader);

            const monthNames = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
            months.forEach((month, i) => {
                const monthCell = document.createElement('div');
                monthCell.className = 'text-center py-2 border-r border-gray-200 text-xs';
                monthCell.innerText = monthNames[month.getMonth()];
                monthCell.style.gridColumn = i + 2;
                gridContainer.appendChild(monthCell);
            });

            // --- Generar Filas de Tareas y Barras ---
            let rowIndex = 3; // Inicia después de las cabeceras de año y mes
            projectData.phases.forEach(phase => {
                // Fila de la Fase
                const phaseRow = document.createElement('div');
                phaseRow.className = 'col-span-1 p-2 font-bold text-indigo-800 bg-indigo-50 border-t border-b border-indigo-100';
                phaseRow.style.gridRow = rowIndex;
                phaseRow.innerText = phase.name;
                gridContainer.appendChild(phaseRow);

                const phaseBg = document.createElement('div');
                phaseBg.className = 'col-start-2 bg-indigo-50 border-t border-b border-indigo-100';
                phaseBg.style.gridRow = rowIndex;
                phaseBg.style.gridColumn = `2 / span ${totalMonths}`;
                gridContainer.appendChild(phaseBg);
                rowIndex++;

                // Filas de las Tareas
                phase.tasks.forEach(task => {
                    const taskStart = new Date(task.start + '-02'); // Use day 2 to avoid timezone issues
                    const startMonthIndex = (taskStart.getFullYear() - start.getFullYear()) * 12 + taskStart.getMonth() - start.getMonth();

                    // Etiqueta de la tarea
                    const taskLabel = document.createElement('div');
                    taskLabel.className = 'text-sm text-gray-700 p-2 pl-4 border-r border-b border-gray-200 truncate';
                    taskLabel.style.gridRow = rowIndex;
                    taskLabel.style.gridColumn = 1;
                    taskLabel.innerText = task.name;
                    gridContainer.appendChild(taskLabel);
                    
                    // Contenedor de la barra (para alinearla verticalmente)
                    const barContainer = document.createElement('div');
                    barContainer.className = 'flex items-center p-1 border-b border-gray-200';
                    barContainer.style.gridRow = rowIndex;
                    barContainer.style.gridColumn = `${startMonthIndex + 2} / span ${task.months || 1}`;
                    
                    if (task.status === 'milestone') {
                        barContainer.style.gridColumn = `${startMonthIndex + 2} / span 1`;
                        const milestone = document.createElement('div');
                        milestone.className = 'milestone-diamond bg-red-500 mx-auto';
                        milestone.title = `${task.name} - ${task.start}`;
                        barContainer.appendChild(milestone);
                    } else {
                         const bar = document.createElement('div');
                        let bgColor = 'bg-gray-300';
                        if (task.status === 'done') bgColor = 'bg-emerald-500';
                        if (task.status === 'active') bgColor = 'bg-indigo-500 animate-pulse';

                        bar.className = `h-6 rounded-md ${bgColor} w-full`;
                        bar.title = `${task.name} (${task.months} meses)`;
                        barContainer.appendChild(bar);
                    }
                    
                    gridContainer.appendChild(barContainer);
                    rowIndex++;
                });
            });

            // --- Añadir Marcador de "Hoy" ---
            const todayIndex = (today.getFullYear() - start.getFullYear()) * 12 + today.getMonth() - start.getMonth();
            if (todayIndex >= 0 && todayIndex < totalMonths) {
                const todayLine = document.createElement('div');
                todayLine.className = 'absolute top-0 bottom-0 w-0.5 bg-red-500 opacity-75 z-30';
                todayLine.style.gridColumn = todayIndex + 2;
                todayLine.style.gridRow = `1 / span ${rowIndex}`;
                
                const todayLabel = document.createElement('div');
                todayLabel.className = 'absolute text-xs font-bold text-white bg-red-500 px-2 py-0.5 rounded-b-md';
                todayLabel.innerText = 'HOY';
                todayLine.appendChild(todayLabel);
                
                gridContainer.appendChild(todayLine);
            }
            
            // Añadir líneas de la cuadrícula vertical
            for (let i = 0; i < totalMonths; i++) {
                const gridLine = document.createElement('div');
                gridLine.className = 'h-full border-r border-gray-200';
                gridLine.style.gridRow = `3 / span ${rowIndex - 2}`;
                gridLine.style.gridColumn = i + 2;
                gridContainer.insertBefore(gridLine, gridContainer.firstChild); // Insertar al fondo
            }

            ganttChart.appendChild(gridContainer);
        });
    </script>
</body>
</html>
