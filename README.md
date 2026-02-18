# 🚀 Gestor de Personal y Asistencias

Un sistema moderno y eficiente para la gestión de recursos humanos, seguimiento de asistencias y administración de documentos, construido con **Laravel 12** y **Filament PHP**.

---

## ✨ Características Principales

### 👥 Gestión de Personal (Workers)
- **Ficha Completa**: Registro de nombre, apellido, DNI, teléfono y correo.
- **Documentación Digital**: Almacenamiento organizado de fotos de perfil, imágenes de DNI (frente/dorso) y contratos.
- **Estados de Empleado**: Control de personal activo e inactivo.
- **Slugs Dinámicos**: Rutas amigables para cada trabajador.

### ⏱️ Control de Asistencias (Attendances)
- **Registro Real**: Seguimiento de entradas y salidas con marcas de tiempo.
- **Estados de Jornada**: Clasificación automática (o manual) de:
    - ✅ **Presente**: Cumplimiento del horario.
    - 🕒 **Tarde**: Ingreso después de la hora prevista.
    - 🚪 **Salida Temprana**: Retiro antes de finalizar la jornada.
- **Notas y Observaciones**: Campo dedicado para aclaraciones por registro.

### 🔒 Administración y Seguridad
- **Roles y Permisos**: Implementación robusta con `Filament Shield` (Admin, Jefe, Empleado).
- **Control de Acceso**: Panel administrativo protegido con verificación de estado activo para usuarios.
- **Perfil de Usuario**: Gestión de fotos, teléfonos y credenciales.

---

## 🛠️ Tecnologías Utilizadas

- **Framework**: [Laravel 12](https://laravel.com)
- **Panel Administrativo**: [Filament PHP 3](https://filamentphp.com)
- **Base de Datos**: MySQL / MariaDB
- **Gestión de Permisos**: [Spatie Permission](https://spatie.be/docs/laravel-permission/v6/introduction)
- **Entorno Local**: Laragon (Recomendado)

---

## 🚀 Instalación y Configuración

Sigue estos pasos para poner en marcha el proyecto en tu entorno local:

1. **Clonar el repositorio**:
   ```bash
   git clone <url-del-repositorio>
   cd gestor
   ```

2. **Instalar dependencias**:
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Configurar el entorno**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurar la base de datos**:
   Edita el archivo `.env` con tus credenciales de base de datos y luego ejecuta:
   ```bash
   php artisan migrate --seed
   ```

5. **Instalar Shield (Roles)**:
   ```bash
   php artisan shield:install
   ```

---

## 📂 Estructura del Proyecto

- `app/Filament/Resources`: Contiene la lógica detallada de los recursos (Schemas y Tables personalizados).
- `app/Models`: Modelos con relaciones y casts configurados.
- `database/migrations`: Historial de cambios en la base de datos, incluyendo campos extra de personal.
- `storage/app/public`: Directorio para almacenamiento de fotos y documentos.

---

## 📝 Licencia

Este proyecto está bajo la licencia [MIT](LICENSE).

---

<p align="center">Desarrollado con ❤️ para la gestión eficiente de equipos.</p>
