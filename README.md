# Custom Header and Footer Plugin

Este plugin de WordPress te permite crear y administrar fácilmente encabezados y pies de página personalizados utilizando el editor visual de WordPress. Una vez creados, los encabezados y pies de página pueden ser fácilmente incluidos en los archivos header.php y footer.php de tu tema. Con este plugin, puedes crear diseños únicos para tus encabezados y pies de página, y mantener la coherencia en todo tu sitio web.

## Instalación

1. Descarga el plugin desde el repositorio de Github.
2. Descomprime el archivo y sube la carpeta a la carpeta `wp-content/plugins/` de tu sitio web.
3. Activa el plugin desde el panel de administración de WordPress.

## Configuración

1. Dirígete al panel de administración de WordPress y haz clic en "Custom Header and Footer" en el menú de la izquierda.
1. Modifica el archivo ``header.php`` de tu tema incluyendo las funciones ``custom_header_footer_get_custom_header``.
![image](https://user-images.githubusercontent.com/10056152/236076210-87b2d64c-3fd9-4d83-993f-eb7f0f26029c.png)
1. Modifica el archivo ``footer.php`` de tu tema incluyendo las funciones ``custom_header_footer_get_custom_footer``
![image](https://user-images.githubusercontent.com/10056152/236076163-5493f565-6a54-4e94-9b27-f1f40a6f38c1.png)
1. Crea un nuevo encabezado o pie de página y personalízalo utilizando el editor visual de WordPress.
    1. IMPORTANTE: solo deberas crear uno de cada uno, tener más de uno podria generar inconsistencias.
![image](https://user-images.githubusercontent.com/10056152/236076419-285debc0-ad33-411f-9321-94d4fcef3b07.png)

¡Listo! Ahora tienes un encabezado y pie de página personalizado para tu sitio web.
![image](https://user-images.githubusercontent.com/10056152/236076836-2277e68e-a362-460a-b6ee-7b8001c51b4d.png)
