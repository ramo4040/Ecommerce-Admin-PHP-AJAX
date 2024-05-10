<?php

namespace App\View;

define('SCRIPT_ROOT', 'http://localhost/ecommerce');
class MainView {
    public static function render(array $data) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin</title>
            <link rel="stylesheet" type="text/css" href="<?php echo SCRIPT_ROOT ?>/public/css/reset.css">
            <link rel="stylesheet" type="text/css" href="<?php echo SCRIPT_ROOT ?>/public/css/style.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        </head>

        <body>
            <main>
                <header>
                    <a href="" class="__logo">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-bag" width="38" height="38" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
                            <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                        </svg>
                        <p>YASSIR</p>
                    </a>

                    <div class="__actions">
                        <button type="button" id="CategoryBtn">Categories <i class="bi bi-gear"></i></button>
                        <button type="button" id="ProductBtn">Add Product <i class="bi bi-plus-lg"></i></button>
                    </div>
                </header>
                <section>
                    <h1>YASSIR.</h1>
                </section>

                <dialog id="__addCategory">
                    <div>
                        <header>
                            <h2>Add Category</h2>
                            <button type="button" id="closeCategoryModal"><i class="bi bi-x-lg"></i></button>
                        </header>

                        <form method="POST" action="api/admin/category" id="formAddCategory">
                            <div class="group-input">
                                <input type="text" placeholder="Category name" name="Category name">
                                <input type="submit" value="Add" name="addCategory">
                            </div>
                        </form>

                        <div class="__categoriesGroup">
                            <?php foreach ($data['categories'] as $value) : ?>
                                <span><?= $value['nameCategory'] ?> <i class="bi bi-trash" id="deleteCategory"></i></span>
                            <?php endforeach ?>
                        </div>
                    </div>
                </dialog>
            </main>

            <section id="__Products">
                <header class="__filter">
                    <h1>All Products</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments-alt filterBtn" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 8h4v4h-4z" />
                        <path d="M6 4l0 4" />
                        <path d="M6 12l0 8" />
                        <path d="M10 14h4v4h-4z" />
                        <path d="M12 4l0 10" />
                        <path d="M12 18l0 2" />
                        <path d="M16 5h4v4h-4z" />
                        <path d="M18 4l0 1" />
                        <path d="M18 9l0 11" />
                    </svg>
                </header>

                <div class="__Categories">
                    <label for="all">All<input type="radio" id="all" class="categoryFilter" name="category" value="All" checked></label>
                    <?php foreach ($data['categories'] as $value) : ?>
                        <?php $name = $value['nameCategory'] ?>
                        <label for="<?= $name ?>"><?= $name ?>
                            <input type="radio" id="<?= $name ?>" class="categoryFilter" name="category" value="<?= $value['idCategory'] ?>">
                        </label>
                    <?php endforeach ?>
                </div>

                <div class="__listProducts">
                    <?= $data['products'] ?>
                </div>

                <dialog id="__addProduct">
                    <form id="formAddProduct" enctype="multipart/form-data">

                        <div class="__generalInfo">
                            <header>
                                <h2>General Information</h2>
                            </header>
                            <div class="groupInput">
                                <div>
                                    <label for="Pname">Product name</label>
                                    <input type="text" id="Pname" name="Product name">
                                    <small class="errorInput" data-name="Product name"></small>
                                </div>
                                <div>
                                    <label for="Pdesc">Description</label>
                                    <textarea name="Description" id="Pdesc" rows="5"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="__productMedia">
                            <header>
                                <h2>Product Media</h2>
                            </header>
                            <div class="images">
                                <label for="photo">Photo Product</label>
                                <div>
                                    <div class="imageDiv">

                                    </div>
                                    <div id="inputfile">
                                        <label for="fileInput" class="file-upload-button">Add Images</label>
                                        <input type="file" id="fileInput" accept="image/png, image/gif, image/jpeg" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="__pricing">
                            <header>
                                <h2>Pricing</h2>
                            </header>
                            <div class="groupInput">
                                <div>
                                    <label for="basePrice">Base Price</label>
                                    <div id="price">
                                        <input type="text" id="basePrice" name="Base Price">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <small class="errorInput" data-name="Base Price"></small>
                                </div>
                            </div>
                        </div>

                        <div class="__category">
                            <header>
                                <h2>Category</h2>
                            </header>
                            <div class="groupInput">
                                <div>
                                    <label for="category">Product Category</label>
                                    <select name="Product Category" id="category">
                                        <?php foreach ($data['categories'] as $value) : ?>
                                            <option value="<?= $value['idCategory'] ?>"><?= $value['nameCategory'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="__btnActions">
                            <input type="button" value="Cancel" id="closeProductModal">
                            <input type="submit" value="Create" name="addProduct">
                        </div>

                    </form>
                </dialog>
            </section>


            <script src="<?php echo SCRIPT_ROOT ?>/public/js/script.js"></script>
        </body>

        </html>
<?php
    }
}
