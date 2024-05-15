# Technical Challenge Spot2 (IC FullStack) 

### Description
En Spot2, una prop-tech pionera en el sector del real estate comercial, reconocemos que la
innovación constante es el pilar de nuestro éxito. Esta dedicación a la vanguardia tecnológica nos
exige no solo diseñar sistemas que escalen eficientemente y cumplan con los más altos
estándares de calidad de código, sino también implementar soluciones que reflejen nuestra
excelencia en la ejecución y nuestras sólidas prácticas de programación. Estamos buscando
individuos apasionados por la tecnología que compartan nuestra dedicación a estos principios,
para que juntos podamos continuar liderando la innovación en el mercado del real estate
comercial.

You can find the total document in the next url - [Challenge Document](docs/doc.pdf)

## 🚀 **Technical Challenge Solution Summary**

The technical challenge was successfully tackled by leveraging Laravel, Vue.js, and Inertia.js, adhering to TDD principles using Pest. Here's a brief summary of the solution:

- **Model and Unit Tests**
    - Models and their respective unit tests were created.
    - The `ShortenedUrl` model was designed to handle URL shortening, ensuring the uniqueness of original URLs.

- **API Controller**
    - An API controller for managing URLs was implemented.
    - It includes methods for fetching, creating, and deleting URLs, returning JSON responses with appropriate status codes.
    - Swagger was used to decorate the API controller and generate documentation.

- **Vue Component Setup**
    - A Vue component named `Urls.vue` was created to display stored URLs in a table format.
    - It communicates with the backend API to fetch and delete URLs, utilizing axios for HTTP requests.

- **Add URL Modal**
    - An `AddUrlModal.vue` component was implemented for adding new URLs.
    - Right Now working on this view.

- **Inertia Integration**
    - Although not fully implemented, the solution is poised for Inertia.js integration to enhance frontend interactivity and improve user experience.
    - Some frontend functionalities are yet to be implemented for a complete user experience.

Overall, the solution demonstrates effective usage of Laravel, Vue.js, and Inertia.js, coupled with TDD practices, to develop a URL shortener application with scalability and maintainability in mind. Further enhancements, particularly regarding the frontend with Inertia.js, remain to be implemented to elevate the user interface and experience.

