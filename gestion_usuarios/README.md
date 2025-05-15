# Sistema de Gestión de Usuarios

Este proyecto implementa un sistema completo de gestión de usuarios con autenticación, roles, y panel de administración.

## Requisitos del Sistema

- Docker desktop

## Instalación y Configuración

1. Clona el repositorio:
   ```
   git clone <URL_DEL_REPOSITORIO>
   ```

2. Navega al directorio del proyecto:
   ```
   cd gestion_usuarios
   ```

3. Inicia los contenedores Docker:
   ```
   docker-compose up -d
   ```

4. Accede a la aplicación en tu navegador:
   ```
   http://localhost:8080
   ```

## Características

- Registro e inicio de sesión de usuarios
- Sistema de roles y permisos
- Panel de administración para gestionar usuarios
- Control de acceso basado en roles
- Registro de actividades e intentos de acceso

## Estructura del Proyecto

```
app/
├── config/         # Configuración de la aplicación
├── public/         # Punto de entrada público
├── src/
│   ├── controllers/ # Controladores de la aplicación
│   ├── Model/       # Modelos para interactuar con la base de datos
│   └── view/        # Vistas y plantillas
```

## Seguridad

El sistema implementa múltiples capas de seguridad para proteger los datos de los usuarios y prevenir vulnerabilidades comunes:

### Autenticación y Contraseñas
- **Hashing de contraseñas**: Todas las contraseñas se almacenan utilizando el algoritmo de hash seguro `PASSWORD_DEFAULT` de PHP.
- **Rehashing automático**: El sistema verifica si una contraseña necesita ser rehashada cuando el usuario inicia sesión, manteniendo la seguridad actualizada.
- **Validación de contraseñas**: Se requieren contraseñas de mínimo 8 caracteres.

### Control de Acceso
- **Sistema de roles**: Implementación de roles (usuario/administrador) para controlar el acceso a funcionalidades específicas.
- **Protección de rutas**: Las páginas administrativas están protegidas y solo accesibles para usuarios con el rol adecuado.
- **Sesiones seguras**: Gestión de sesiones para mantener el estado de autenticación de forma segura.

### Protección contra Ataques
- **Sanitización de entrada**: Todos los datos ingresados por los usuarios son sanitizados para prevenir inyecciones SQL y XSS.
- **Validación de datos**: Validación en el lado del servidor para todos los formularios.
- **Prevención de CSRF**: Implementación de tokens para formularios críticos.

### Monitoreo y Auditoría
- **Registro de accesos**: El sistema mantiene un log detallado de todos los intentos de acceso (exitosos y fallidos).
- **Seguimiento de IP**: Se registra la dirección IP en cada intento de acceso para ayudar a identificar posibles ataques.
- **Log de actividades**: Las acciones importantes se registran para futuras auditorías de seguridad.

### Base de Datos
- **Conexiones PDO seguras**: Uso de PDO con prepared statements para prevenir inyecciones SQL.
- **Parámetros vinculados**: Todas las consultas utilizan parámetros vinculados para mayor seguridad.

### Configuración y Despliegue
- **Variables de entorno**: Las credenciales sensibles se almacenan en variables de entorno en lugar de estar hardcodeadas.
- **Estructura segura**: Los archivos de configuración y código sensible están fuera del directorio web público.

## Uso

### Usuarios Regulares
1. Registrarse en el sistema
2. Iniciar sesión con credenciales
3. Acceder al dashboard de usuario
4. Actualizar información de perfil

### Administradores
1. Iniciar sesión con cuenta de administrador
2. Acceder al panel de administración
3. Gestionar usuarios (ver, editar, eliminar)
4. Revisar logs de actividad

## Licencia

[Incluir información de licencia]

## Contacto

[Información de contacto]
