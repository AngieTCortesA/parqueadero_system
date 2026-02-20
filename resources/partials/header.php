<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ??'Mi sitio web' ?></title>
    <link rel="shortcut icon" href="/assets/images/3shape-intraoral-logo.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="/assets/images/3shape-intraoral-logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
     * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #222;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0px;
            background: #fff;
        }
        
        .header {
            width: 100vw;
            min-width: 100vw;
            margin-left: 0;
            margin-right: 0;
            background-color: #223142;
            color: #c7264e;
            padding: 0;
            border-radius: 0;
            border: none;
            box-shadow: 0 2px 8px rgba(199,38,78,0.04);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            left: 50%;
            right: 50%;
            transform: translateX(-50%);
        }
        
        .header-inner {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #223142;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #223142;
        }
        
        .header-content {
            text-align: left;
        }
        
        .header-actions {
            display: flex;
            gap: 10px;
        }
        
        .header-actions a {
            color: #c7264e;
            text-decoration: none;
            padding: 8px 16px;
            border: 1px solid #c7264e;
            border-radius: 5px;
            transition: all 0.3s;
            background: #fff;
        }
        
        .header-actions a:hover {
            background-color: #c7264e;
            color: #fff;
        }
        
        .nav {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .nav a {
            color: #c7264e;
            text-decoration: none;
            margin: 0 15px;
            padding: 10px 20px;
            border: 1px solid #c7264e;
            border-radius: 5px;
            transition: all 0.3s;
            background: #fff;
        }
        
        .nav a:hover {
            background-color: #c7264e;
            color: #fff;
        }
        
        .card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(199,38,78,0.07);
            border: 1px solid #ececec;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 16px;
            background: #faf9fa;
            color: #222;
        }
        
        button {
            background-color: #c7264e;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
    
        .mensaje {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        
        .mensaje.success {
            background-color: #f6e6ea;
            color: #c7264e;
            border: 1px solid #c7264e;
        }
        
        .mensaje.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .cupos-info {
            background-color: #f6e6ea;
            border-left: 4px solid #c7264e;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .reserva-item {
            background-color: #faf9fa;
            border-left: 4px solid #c7264e;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        
        .reserva-item h4 {
            margin-bottom: 8px;
            color: #c7264e;
        }
        
        .reserva-item p {
            margin-bottom: 5px;
        }
        
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                gap: 15px;
            }
            
            .header-actions {
                flex-wrap: wrap;
            }
        }
        .mapa-titulo {
            display: flex;
            align-items: center;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 18px;
            gap: 10px;
        }
        .mapa-leyenda {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
        .mapa-leyenda span {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #c7264e;
        }
        .mapa-espacios-bg {
            background: #f8fafc;
            border-radius: 18px;
            padding: 28px 16px 18px 16px;
            margin-bottom: 18px;
            display: flex;
            justify-content: center;
            width: 100%;
            min-height: 120px;
            box-sizing: border-box;
        }
        #mapa-espacios {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(70px, 1fr));
            gap: 18px;
            justify-items: center;
            align-items: center;
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }
        #mapa-espacios::-webkit-scrollbar {
            height: 10px;
        }
        #mapa-espacios::-webkit-scrollbar-thumb {
            background: #2563eb;
            border-radius: 6px;
        }
        #mapa-espacios::-webkit-scrollbar-track {
            background: #f8fafc;
        }
        .espacio-btn {
            min-width: 60px;
            max-width: 80px;
            width: 70px;
            height: 80px;
            border-radius: 14px;
            border: none;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(44,62,80,0.07);
            transition: box-shadow 0.2s, transform 0.2s, background 0.2s;
            margin-bottom: 0;
            cursor: pointer;
            outline: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .espacio-btn.disponible {
            background: #22c55e;
            color: #fff;
        }
        .espacio-btn.ocupado {
            background: #b0b0b0;
            color: #fff;
            cursor: not-allowed;
            opacity: 0.7;
        }
        .espacio-btn.seleccionado {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 0 0 4px #2563eb33;
            border: 2px solid #2563eb;
        }
        .espacio-btn .icono-auto {
            font-size: 1.5rem;
            margin-bottom: 4px;
        }
        @media (max-width: 900px) {
            #mapa-espacios {
                grid-template-columns: repeat(auto-fit, minmax(50px, 1fr));
                gap: 10px;
                max-width: 100vw;
            }
            .espacio-btn {
                min-width: 40px;
                max-width: 60px;
                width: 50px;
                height: 60px;
                font-size: 13px;
            }
            .espacio-btn .icono-auto {
                font-size: 1.1rem;
            }
        }
        .form-reserva-oculto {
            display: none;
        }
        .form-reserva-visible {
            display: block;
            animation: fadeIn 0.4s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: none; }
        }
        #mapa-espacios-carro, #mapa-espacios-moto {
            display: flex;
            gap: 18px;
            flex-wrap: nowrap;
            justify-content: center;
            align-items: center;
            width: 100%;
            overflow-x: auto;
            scrollbar-width: thin;
            scrollbar-color: #2563eb #f8fafc;
        }
        #mapa-espacios-carro::-webkit-scrollbar, #mapa-espacios-moto::-webkit-scrollbar {
            height: 10px;
        }
        #mapa-espacios-carro::-webkit-scrollbar-thumb, #mapa-espacios-moto::-webkit-scrollbar-thumb {
            background: #2563eb;
            border-radius: 6px;
        }
        #mapa-espacios-carro::-webkit-scrollbar-track, #mapa-espacios-moto::-webkit-scrollbar-track {
            background: #f8fafc;
        }
        #mapa-motos-grid {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-auto-rows: 100px;
            gap: 18px;
            justify-content: center;
            align-items: center;
            margin-bottom: 12px;
            min-height: 420px;
        }
        @media (max-width: 600px) {
            #mapa-motos-grid {
                grid-template-columns: repeat(3, 60px);
                grid-auto-rows: 60px;
                gap: 8px;
                min-height: 250px;
            }
        }
        .tooltip-cupos {
            visibility: hidden;
            opacity: 0;
            background: #222;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 6px 12px;
            position: absolute;
            z-index: 10;
            bottom: 110%;
            left: 50%;
            transform: translateX(-50%);
            font-size: 14px;
            pointer-events: none;
            transition: opacity 0.2s;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(0,0,0,0.18);
        }
        .espacio-btn:hover .tooltip-cupos,
        .espacio-btn:focus .tooltip-cupos {
            visibility: visible;
            opacity: 1;
        }
        @media (max-width: 700px) {
            .tooltip-cupos {
                display: none;
            }
            #info-cupos-movil {
                display: block;
                margin: 10px auto 0 auto;
                text-align: center;
                font-size: 15px;
                color: #2563eb;
                background: #f1f5fa;
                border-radius: 8px;
                padding: 7px 12px;
                max-width: 300px;
            }
        }
        @media (min-width: 701px) {
            #info-cupos-movil {
                display: none;
            }
        }
  </style>
</head>
<body>
  <div class="mb-8">
  <?php require __DIR__ . '/navbar.php'; ?>
  </div>

    <div class="container mx-auto p-4">