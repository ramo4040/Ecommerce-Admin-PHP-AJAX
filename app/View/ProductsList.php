<?php

namespace App\View;

class ProductsList {
    public static function main($products) {
        ob_start();

?>
        <section id="__productsSection">
            <?php foreach ($products as $value) : ?>
                <?php
                $image = json_decode($value['images'], true);
                ?>
                <div id="product">
                    <div class="image">
                        <a href=""><img src="/ecommerce/product_images/<?= $value['idProduct'] ?>/<?= $image[0] ?>"></a>
                    </div>
                    <div class="details">
                        <h2><?= $value['nameProduct'] ?></h2>
                        <footer>
                            <div class="price">
                                <small>Price</small>
                                <h2>$ <?= $value['priceProduct'] ?></h2>
                            </div>
                            <form id="deleteProduct">
                                <input type="submit">
                                <input type="hidden" name="id" value="<?= $value['idProduct'] ?>">
                                <i class="bi bi-trash"></i>
                            </form>
                        </footer>
                    </div>
                </div>
            <?php endforeach ?>
        </section>
<?php
        return ob_get_clean();
    }
}
