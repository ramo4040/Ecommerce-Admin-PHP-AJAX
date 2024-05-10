const get = (name) => document.querySelector(name);

// Category Modal handling 
get('#CategoryBtn').addEventListener('click', () => {
    get('#__addCategory').showModal();
});

get('#closeCategoryModal').addEventListener('click', () => {
    get('#__addCategory').close();
});


// Category deletion handling
get('.__categoriesGroup').addEventListener('click', async (e) => {
    if (e.target.matches('#deleteCategory') && confirm('confirm')) {
        const data = e.target.parentElement.textContent.trim();
        const request = await fetch('api/admin/category', {
            method: 'DELETE',
            body: JSON.stringify(data)
        });

        if (request.ok) {
            window.location.href = 'http://localhost/ecommerce/admin';
        }
    }
});

// Product Modal handling
const formAddProduct = document.forms['formAddProduct'];

get('#ProductBtn').addEventListener('click', () => {
    get('#__addProduct').showModal();
});
get('#closeProductModal').addEventListener('click', () => {
    // Reset form, clear images, and close the modal
    formAddProduct.reset();
    [...get('.imageDiv').children].forEach(e => e.remove());
    get('#__addProduct').close();
});

// Product image handling
let images = [];
formAddProduct.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(formAddProduct);
    images.forEach((image) => {
        formData.append('images[]', image);
    });

    const request = await fetch('api/admin/product', {
        method: 'POST',
        body: formData,
    });

    if (request.ok) {
        window.location.href = 'http://localhost/ecommerce/admin';
    } else {
        const response = await request.json();
        const elements = document.querySelectorAll('.errorInput');

        for (const element of elements) {
            const name = element.dataset.name;
            element.innerText = name in response ? response[name] : element.innerText = "";
        }
    }

});
get('#fileInput').addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const img = document.createElement('img');
            img.src = e.target.result; // Data URL
            get('.imageDiv').appendChild(img);
            images.push(file);
        };
        reader.readAsDataURL(file);
    }
});


// Product deletion handling
get('.__listProducts').addEventListener('submit', async (e) => {
    e.preventDefault();
    if (confirm("confirm")) {
        const formData = new FormData(e.target);
        const request = await fetch('api/admin/product', {
            method: "DELETE",
            body: JSON.stringify(formData.get('id'))
        });

        if (request.ok) e.target.closest('#product').remove();
    }

});

// Product filtering by category
get('.__Categories').addEventListener('change', async (e) => {
    const categoryId = e.target.value;
    const query = categoryId == 'All' ? 'products' : `products?category_id=${categoryId}`;
    const request = await fetch(`http://localhost/ecommerce/api/admin/${query}`, {
        method: 'GET',
    });

    if (request.ok) {
        const data = await request.json();
        get('#__productsSection').remove();
        let section = document.createElement('section');
        section.setAttribute('id', '__productsSection');

        data.forEach(e => {
            const image = JSON.parse(e.images);
            section.innerHTML += `
            <div id="product">
            <div class="image">
                <a href=""><img src="/ecommerce/product_images/${e.idProduct}/${image[0]}"></a>
            </div>
            <div class="details">
                <h2>${e.nameProduct}</h2>
                <footer>
                    <div class="price">
                        <small>Price</small>
                        <h2>$ ${e.priceProduct}</h2>
                    </div>
                    <form id="deleteProduct">
                        <input type="submit">
                        <input type="hidden" name="id" value="${e.idProduct}">
                        <i class="bi bi-trash"></i>
                    </form>
                </footer>
            </div>
        </div>
            `;
        });

        get('.__listProducts').appendChild(section);
    }


});