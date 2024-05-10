## Ecommerce Admin Panel (PHP & AJAX)

This repository showcases a custom-built ecommerce admin panel developed using core PHP and AJAX. The project focuses on implementing key functionalities for managing an online store, including product and category management. 

**Features:**

*   **Product Management:**
    *   Create new products
    *   View a list of all products
    *   Delete existing products
*   **Category Management:**
    *   Create new categories
    *   View all categories
    *   Retrieve a specific category by ID
    *   Delete existing categories
*   **Dynamic Interface:** Utilizes AJAX for seamless interactions and real-time updates without page reloads.
*   **RESTful API Integration:**  Includes API endpoints for managing product and category data.
*   **Custom Routing:** Implements routing logic for handling navigation and requests within the admin panel.
*   **Dependency Management:**  Employs a service container for organized dependency management.

**Technical Stack:**

*   PHP
*   AJAX
*   JavaScript
*   HTML
*   CSS

## Category API:

| Method | Endpoint                | Description                                     |
| :----- | :----------------------- | :---------------------------------------------- |
| POST    | /api/admin/category     | Create a new category.                         |
| GET     | /api/admin/categories    | Retrieve a list of all categories.              |
| GET     | /api/admin/category/{id} | Get a specific category by its ID.              |
| DELETE  | /api/admin/category     | Delete a category.                             |

## Product API:

| Method | Endpoint           | Description                               |
| :----- | :----------------- | :---------------------------------------- |
| POST    | /api/admin/product | Create a new product.                     |
| GET     | /api/admin/products| Retrieve a list of all products.          |
| DELETE  | /api/admin/product | Delete a product.                         |

## Web Endpoints:

| Method | Endpoint | Description                         |
| :----- | :------- | :---------------------------------- |
| GET     | /admin   | Access the main admin panel interface. | 

**Getting Started:**

1.  Clone the repository: `git clone https://github.com/ramo4040/Ecommerce-Admin-PHP-AJAX.git`
2.  Set up your database and configure the connection details. <br>
    import sql file<br>
    config = > App/Config/Config.php && App/Config/Database.php<br>
4.  Run the application like this ( `http://localhost/ecommerce/admin` )

**Contribution:**

Feel free to explore the code, suggest improvements, or contribute to the project by creating pull requests. 

## Contact

<a href="https://www.linkedin.com/in/yassir-rouane/">Linkedin</a>
