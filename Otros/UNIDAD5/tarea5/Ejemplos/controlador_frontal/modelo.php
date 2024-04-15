<?php
    // modelo.php
    // MVC Controlador Frontal: Modelo
    function cargar_datos() {
        //Carga de los datos (interaccionar con la base de datos para obtener datos)
        $articulos = array(
            0 => array(
                "id" => 0,
                "titulo" => "MSI G244F 23.8' LED Rapid IPS FullHD 170Hz FreeSync Premium",
                "precio" => 124.99,
                "imagen" => "imagenes/MSI G244F 23.8' LED.jpg",
                "descripcion" => "Entra en acción al instante con el WD_BLACK™ SN770 NVMe™ SSD. Este disco se ha diseñado específicamente para jugar y cuenta con la interfaz PCIe® Gen4, que ofrece una velocidad impresionante de hasta 5150 MB/s (en los modelos de 1 TB y 2 TB).",
                "caracteristicas" => "Impulsada por NVIDIA DLSS 3, arco Ada Lovelace ultraeficiente y trazado de rayos completo
                Refrigeración avanzada IceStorm 2.0
                Parada de ventilador FREEZE, Control de ventilador activo
                Huella de ranura compacta 2.2
                Iluminación SPECTRA 2.0 RGB
                Placa posterior de metal
                Incluida con soporte de soporte de GPU
                Todas las utilidades de la nueva FireStorm: Descargar aquí
                3 años de garantía + 2 años de garantía después del registro"),
            1 => array(
                "id" => 1,
                "titulo" => "WD BLACK SN770 1TB SSD PCIe Gen4 NVMe",
                "precio" => 59.99,
                "imagen" => "imagenes/WD_BLACK_SN770.png",
                "descripcion" => "Entra en acción al instante con el WD_BLACK™ SN770 NVMe™ SSD. Este disco se ha diseñado específicamente para jugar y cuenta con la interfaz PCIe® Gen4, que ofrece una velocidad impresionante de hasta 5150 MB/s (en los modelos de 1 TB y 2 TB).",
                "caracteristicas" => "INTERFAZ: PCIe® Gen4 16GT/s, hasta 4 carriles
                DIMENSIONES:
                LONGITUD: 80 ± 0,15 mm
                ANCHO: 22 ± 0,15 mm
                ALTURA: 2,38 mm
                PESO: 5,5g ± 0,5g
                RESISTENCIA (TBW):
                2 TB: 1200"),
            2 => array(
                "id" => 2,
                "titulo" => "Zotac Gaming GeForce RTX 4070 Twin Edge 12GB GDDR6X DLSS3",
                "precio" => 579.90,
                "imagen" => "imagenes/Zotac_Gaming_GeForce_RTX_4070.png",
                "descripcion" => "La ZOTAC GAMING GeForce RTX 4070 Twin Edge es una tarjeta gráfica compacta y potente que presenta la arquitectura NVIDIA Ada Lovelace y un diseño inspirado en la aerodinámica. Con un tamaño de ranura reducido de 2.2, es una excelente opción para aquellos que desean construir una PC para juegos SFF capaz de una alta velocidad de fotogramas y rendimiento en los últimos lanzamientos de títulos.",
                "caracteristicas" => "Impulsada por NVIDIA DLSS 3, arco Ada Lovelace ultraeficiente y trazado de rayos completo
                Refrigeración avanzada IceStorm 2.0
                Parada de ventilador FREEZE, Control de ventilador activo
                Huella de ranura compacta 2.2
                Iluminación SPECTRA 2.0 RGB
                Placa posterior de metal
                Incluida con soporte de soporte de GPU
                Todas las utilidades de la nueva FireStorm: Descargar aquí
                3 años de garantía + 2 años de garantía después del registro"),
        );
        return $articulos;
    }

    function listar_articulos() {
        $articulos = cargar_datos();
        return $articulos;
    }

    function detalle_articulos($id) {
        $articulos = cargar_datos();
        return $articulos[$id];
    }
?>