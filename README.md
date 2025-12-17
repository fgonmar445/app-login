# 🛡️ Ejercicios de Implementación de Login con PHP + MariaDB

Este repositorio contiene ejemplos prácticos de cómo implementar un sistema de **login seguro** utilizando **PHP** y **MariaDB**, aplicando diversas mejoras de seguridad tanto en el **frontend** como en el **backend**.

---

## 🚀 Objetivos del proyecto
- Implementar un sistema de autenticación básico con PHP y MySQL.
- Aplicar buenas prácticas de seguridad en el manejo de sesiones y cookies.
- Proteger la aplicación contra ataques comunes (CSRF, fuerza bruta, etc.).
- Documentar y probar cada mejora de seguridad.

---

## 🔒 Mejoras de seguridad implementadas

1. **Validación en el frontend con JavaScript**
   - Validación de tamaño mínimo y máximo para `idusuario` y contraseña (8–15 caracteres).
   - La contraseña debe incluir:
     - Letras mayúsculas y minúsculas.
     - Números.
     - Caracteres especiales permitidos: `! @ # $ % ^ & * - _ + ? . , : ;`
   - Se excluyen caracteres peligrosos como `' " \ / < > = ( )`.

2. **Cookies de sesión seguras**
   - Configuración de cookies con atributos:
     - `HttpOnly`
     - `Secure`
     - `SameSite=Strict`

3. **Protección CSRF**
   - Generación de un **token CSRF** almacenado en la sesión.
   - Inclusión del token en formularios ocultos.
   - Verificación del token antes de ejecutar operaciones críticas:
     - Consultar datos sensibles.
     - Insertar, modificar o eliminar registros.

4. **Logout seguro**
   - Eliminación explícita de la cookie de sesión.
   - Destrucción de la sesión en el servidor.

5. **Configuración de `php.ini`**
   - Localización y ajuste de parámetros relevantes:
     - `session.cookie_lifetime`
     - `session.gc_maxlifetime`
     - `session.use_strict_mode`
     - `session.cookie_secure`

6. **Expiración de cookies**
   - Implementación y prueba de tiempos de expiración configurables.

7. **Regeneración de cookies y sesiones**
   - Regeneración de ID de sesión cada cierto tiempo (ej. cada 15 minutos).
   - Tiempo límite de sesión: 2 horas.

8. **Control de intentos de acceso**
   - Límite de 5 intentos fallidos de login.
   - Bloqueo temporal del usuario tras superar el límite.

---


---

## 🧪 Pruebas realizadas
- Validación de contraseñas en frontend.
- Verificación de cookies seguras en navegador.
- Comprobación de token CSRF en operaciones críticas.
- Logout elimina correctamente la cookie de sesión.
- Expiración y regeneración de cookies probadas.
- Sesiones expiran tras 2 horas de inactividad.
- Bloqueo tras 5 intentos fallidos de login.

---

## ⚙️ Requisitos
- PHP >= 8.0
- MySQL >= 5.2.1
- Navegador moderno con soporte para `SameSite` cookies

---

## 📌 Notas
Este proyecto es **educativo** y está orientado a la práctica de conceptos de seguridad en aplicaciones web. No debe usarse en producción sin una revisión exhaustiva de seguridad.

---

## 👨‍💻 Autor
Felipe Gonzalez - Proyecto desarrollado como ejercicio de clase para reforzar conceptos de **seguridad en aplicaciones web**.


