# 🚀 Gestión de Flota de Star Wars: Backend API

El objetivo es diseñar el backend para la gestión de la flota, pilotos y mantenimiento de naves del universo Star Wars, usando **Eloquent ORM** y las relaciones entre sus modelos.

* **Fuente de Datos Principal:** [SWAPI - The Star Wars API](https://swapi.dev/api/)

---

## 🛰️ Modelos y Estructura de Datos

### Planetas
Un planeta tendrá asociado varias naves.
* `nombre`
* `período de rotación`
* `población`
* `clima`

### Naves
Las naves pertenecen a un planeta, pueden tener varios mantenimientos y varios pilotos asociados a lo largo del tiempo.
* `nombre`
* `modelo`
* `tripulación`
* `pasajeros`
* `clase de nave`

### Pilotos
Información que se debe guardar de los pilotos.
* `nombre`
* `altura`
* `año de nacimiento`
* `género`

### Mantenimientos
* `id`
* `idnave`
* `fecha`
* `descripción`
* `coste`

### 📋 Tabla Pivote (pilot_spaceship)
Para gestionar qué naves son pilotadas por qué pilotos, se necesita una tabla pivote con la siguiente información:
* ID del piloto 
* ID de la nave 
* Fecha de inicio de la asociación 
* Fecha de fin de la asociación 

---

## ✅ Requisitos Funcionales del Cliente

La API debe ofrecer la siguiente información y funcionalidades:

1.  **CRUD de naves.** Inicialmente con acceso abierto, pero con la posibilidad de protegerlo en el futuro.

2.  **Listado de toda la información almacenada.** Se necesitan tanto listados generales como búsquedas por `id` para cada modelo.

3.  **Asignar/Desasignar un piloto a una nave.** Debe incluir un control de errores.

4.  **Listar todas las naves** que no tienen un piloto asignado actualmente.

5.  **Listar el histórico de todos los pilotos** que han sido asignados a naves (no tienen por qué estar asignados actualmente).

6.  Igual que el punto anterior, pero mostrando **únicamente los pilotos que están asociados a naves en el presente**, junto con la información de dichas naves.

7.  **Registrar un mantenimiento** para una nave.

8.  **Listar mantenimientos puntuales** (búsqueda por ID).

9.  **Listar los mantenimientos de una nave** que se hayan realizado entre dos fechas.

## Que la fuerza te acompañe
