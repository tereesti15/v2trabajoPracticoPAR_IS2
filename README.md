# 💼 Sistema de Nómina

Sistema web para la gestión de nómina de empleados, desarrollado con Laravel 12, Livewire y Bootstrap. Permite administrar empleados, conceptos salariales, generar nóminas, emitir reportes y gestionar usuarios con distintos roles. La aplicación responde con JSON y cuenta con documentación integrada usando Swagger.

---

## Tecnologías utilizadas

- Laravel 12+
- Livewire
- Bootstrap 5+
- MariaDB 10+
- Swagger (L5-Swagger)
- Composer
- NPM / Vite

---

## Requisitos

- PHP 8+
- Composer 2+
- Node.js 22+
- NPM 10+
- MariaDB 10+
- Laravel CLI

---

## Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/tereesti15/v2trabajoPracticoPAR_IS2.git
   cd Sistema-de-Nomina
   ```

2. Instala las dependencias de PHP:
   ```bash
   composer install
   ```

3. Copia el archivo de entorno y configura tu base de datos:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Instala dependencias frontend y compila assets:
   ```bash
   npm install
   npm run dev
   ```

5. Ejecuta migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```

6. Inicia el servidor:
   ```bash
   php artisan serve
   ```

---

## Documentación API (Swagger)

La documentación Swagger está disponible en:  
👉 [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)

---

## Roles y accesos

| Rol             | Acceso | Usuario de prueba                  | Contraseña     |
|------------------|--------|--------------------------------------|----------------|
| Administrador    | Acceso total                               | admin@example.com     | password123     |
| Gerente          | Consulta de empleados y reportes           | gerente@example.com   | password123     |
| Asistente RRHH   | Gestión de empleados y liquidaciones       | asistente@example.com | password123     |
| Empleado         | Solo lectura de sus datos y recibos        | empleado@example.com  | password123     |

---

##  Funcionalidades

###  1. Inicio de Sesión
Formulario de autenticación por rol.  
Pasos:
1. Ingresar al sistema vía navegador.
2. Introducir credenciales.
3. Presionar "Iniciar sesión".

---

###  2. Dashboard Principal
Disponible para el Administrador, con datos como:
- Total de empleados distribuidos por sexo.
- Distribución de costos por departamento.

---

###  3. Gestión de Personas y Empleados

#### 3.1. CRUD Personas
- Registro de datos personales (nombre, documento, nacimiento, etc.).
- Administración de hijos.

#### 3.2. CRUD Hijos
- Asociado a cada persona.
- Campos: nombre, documento, fecha de nacimiento.

#### 3.3. CRUD Empleados
- Asignación de salario base.
- Acciones: editar, eliminar, asignar ingresos/egresos.

---

###  4. Gestión de Nómina

#### 4.1. Generar planilla
- Selección de año y mes.
- Generación y confirmación de nómina.

#### 4.2. Visualizar planilla
- Vista detallada y opción de exportación a PDF.

---

###  5. Configuración

#### 5.1. Conceptos Salariales
- Acreditaciones (suman al salario).
- Descuentos (restan del salario).
- CRUD completo.

#### 5.2. Parámetros del sistema
- Nombre y RUC de la empresa.
- Salario mínimo y porcentajes de bonificación.
- Códigos para salario base, IPS, bonificación familiar.

---


##  Contacto

Desarrollado por: **Jorge Bello y Teresa Estigarribia**  
📧 Email: [jorgebell@gmail.com/tere_esti@gmail.com]

---

## 🪪 Licencia

Este proyecto está licenciado bajo la Licencia MIT.