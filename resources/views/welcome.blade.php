<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manejo del RN Expuesto a Varicela Materna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            width: 100%;
            max-width: 1000px;
        }
        .node {
            background-color: #ffffff;
            border: 2px solid #87CEEB;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: relative;
            min-width: 180px;
        }
        .start-node {
            background-color: #0077b6;
            color: white;
            padding: 15px 25px;
            font-size: 1.2em;
            border-color: #005a8d;
        }
        .decision-node {
            background-color: #b0e0e6;
            font-style: italic;
        }
        .action-node {
            background-color: #e0f7fa;
        }
        .critical-node {
            background-color: #ffcdd2;
            border-color: #c62828;
        }
        .row {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 30px;
            width: 100%;
        }
        .branch {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            position: relative;
            flex: 1;
        }
        .connector-path {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .connector-horizontal {
            position: absolute;
            height: 2px;
            background-color: #0077b6;
            top: -25px;
        }
        .connector-vertical {
            width: 2px;
            height: 25px;
            background-color: #0077b6;
        }
        .label {
            background-color: #f0f8ff;
            padding: 2px 8px;
            font-size: 0.9em;
            font-weight: bold;
            color: #333;
            border: 1px solid #b0e0e6;
            border-radius: 15px;
            margin-bottom: 5px;
        }
        h1 {
            color: #005a8d;
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manejo del Recién Nacido Expuesto a Varicela Materna</h1>
        <div class="node start-node">Neonato Expuesto</div>

        <div class="connector-path">
            <div class="connector-vertical"></div>
            <div class="connector-horizontal" style="width: 80%; left: 10%;"></div>
        </div>

        <div class="row">
            <div class="branch">
                <div class="connector-vertical"></div>
                <div class="label" style="background-color: #ffdcb3; border-color: #ff8c00;">Infección Materna < 20 sem</div>
                <div class="node">
                    <strong>Riesgo de Síndrome de Varicela Congénita</strong><br>
                    <small>Cicatrices, hipoplasia de miembros, alt. oculares/SNC.</small>
                </div>
            </div>
            <div class="branch">
                <div class="connector-vertical"></div>
                <div class="label" style="background-color: #c8e6c9; border-color: #388e3c;">Erupción Materna >5 días ANTES del parto</div>
                <div class="node action-node">
                    <strong>Bajo Riesgo</strong><br>
                    RN recibió anticuerpos maternos.
                    <hr style="border-color: #87CEEB; margin: 5px 0;">
                    <strong>Conducta:</strong> Observación clínica.
                </div>
            </div>
            <div class="branch">
                <div class="connector-vertical"></div>
                <div class="label" style="background-color: #ffcdd2; border-color: #c62828;">Erupción Materna Periparto<br>(-5 días a +2 días del parto)</div>
                <div class="node critical-node">
                    <strong>¡ALTO RIESGO!</strong><br>
                    RN recibe virus SIN anticuerpos.
                </div>
                <div class="connector-path">
                     <div class="connector-vertical"></div>
                </div>
                 <div class="node decision-node">¿Neonato sintomático?</div>
                 <div class="connector-path">
                    <div class="connector-vertical"></div>
                    <div class="connector-horizontal" style="width: 100%; left: 0;"></div>
                 </div>
                 <div class="row">
                    <div class="branch">
                        <div class="connector-vertical"></div>
                        <div class="label" style="font-size:0.8em">NO (Asintomático)</div>
                        <div class="node action-node">
                           <strong>PROFILAXIS</strong><br>
                           Dar VZIG Inmediata
                        </div>
                    </div>
                     <div class="branch">
                        <div class="connector-vertical"></div>
                        <div class="label" style="font-size:0.8em">SÍ (Lesiones)</div>
                        <div class="node critical-node">
                           <strong>TRATAMIENTO</strong><br>
                           Iniciar Aciclovir IV
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</body>
</html>
