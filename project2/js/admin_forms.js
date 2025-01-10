function add_product(){
    const instructions = document.querySelector('.instructions');
    const form = document.querySelector('.question-form');

    instructions.innerHTML = ("Please fill out all required fields with an asterisk (*).")

    form.innerHTML = "";
    form.action = "admin_add.php";
    form.enctype = "multipart/form-data";

    const fields = [
        { label: 'Product Name:', name: 'name'},
        { label: 'Image: ', name: 'image', type: 'file'},
        { label: 'Description:', name: 'description'},
        { label: 'Price:', type: 'number', step: true, name: 'price', min: true},
        { label: 'Quantity:', type: 'number', name: 'quantity', min: true},
        { label: 'Rating:', name: 'rating', type: 'number', min: true, max: true}
        ];
    createForm(fields, form);
    submit_button(form);
}
function discontinue_product(){
    const instructions = document.querySelector('.instructions');
    const form = document.querySelector('.question-form');

    instructions.innerHTML = ("Please select a product to discontinue.")

    form.action = "admin_discontinue.php";
    form.innerHTML = "";
    form.method = "post";

    fetch_current_products(form);
    submit_button(form);
}

function reinstate_product(){
    const instructions = document.querySelector('.instructions');
    const form = document.querySelector('.question-form');

    instructions.innerHTML = ("Please select a product to reinstate.")

    form.action = "admin_reinstate.php";
    form.innerHTML = "";
    form.method = "post";

    fetch_discontinued_products(form);
    submit_button(form);
}
function update_product(){
    const instructions = document.querySelector('.instructions');
    const form = document.querySelector('.question-form');

    instructions.innerHTML = ("Please fill out only the fields you wish to change.")

    form.innerHTML = "";
    form.action = "admin_update.php";
    form.enctype = "multipart/form-data";

    fetch_all_products(form);
    const fields = [
        { label: 'Product Name:', name: 'name'},
        { label: 'Image: ', name: 'image', type: 'file'},
        { label: 'Description:', name: 'description'},
        { label: 'Price:', type: 'number', step: true, name: 'price', min: true},
        { label: 'Quantity:', type: 'number', name: 'quantity', min: true},
        { label: 'Rating:', name: 'rating', type: 'number', min: true, max: true}
    ];
    createForm(fields, form);
    submit_button(form);
}

function createForm(fields, form) {
    // Loop through fields to add inputs to the form
    form.method = "post";
    fields.forEach(field => {
        const label = document.createElement('label');
        label.textContent = field.label;
        label.htmlFor = field.name;

        const input = document.createElement('input');
        input.type = field.type || 'text'; // Default to text if type is not provided
        input.name = field.name;
        input.id = field.name;

        if (field.required) {
            input.required = true;
            label.textContent += " *";
        }

        if(field.step){
            input.step = ".01";
        }

        if (field.min){
            input.min = "0";
        }
        if (field.max){
            input.max = "5";
        }

        form.appendChild(label);
        form.appendChild(input);
    });
}

function fetch_all_products(form){
    const label = document.createElement('label');
    label.textContent = "Select a product to update:";
    label.htmlFor = "ProductID";

    const select = document.createElement('select');
    select.name = "ProductID";
    select.id = "ProductID";

    form.appendChild(label);
    form.appendChild(select);

    fetch('admin_get_all_products.php')
        .then(response => response.json())
        .then(products => {
            products.forEach(product => {
                const option = document.createElement('option');
                option.value = product.ProductID; // Set the value to the product ID
                option.textContent = product.Name; // Set the text to the product name
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            const errorMessage = document.createElement('p');
            errorMessage.textContent = "Failed to load products. Please try again.";
            form.appendChild(errorMessage);
        });
}

function fetch_current_products(form){
    const label = document.createElement('label');
    label.textContent = "Select a product to discontinue:";
    label.htmlFor = "ProductID";

    const select = document.createElement('select');
    select.name = "ProductID";
    select.id = "ProductID";

    form.appendChild(label);
    form.appendChild(select);

    fetch('admin_get_current_products.php')
        .then(response => response.json())
        .then(products => {
            products.forEach(product => {
                const option = document.createElement('option');
                option.value = product.ProductID; // Set the value to the product ID
                option.textContent = product.Name; // Set the text to the product name
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            const errorMessage = document.createElement('p');
            errorMessage.textContent = "Failed to load products. Please try again.";
            form.appendChild(errorMessage);
        });
}

function fetch_discontinued_products(form){
    const label = document.createElement('label');
    label.textContent = "Select a product to reinstate:";
    label.htmlFor = "ProductID";

    const select = document.createElement('select');
    select.name = "ProductID";
    select.id = "ProductID";

    form.appendChild(label);
    form.appendChild(select);

    fetch('admin_get_discontinued_products.php')
        .then(response => response.json())
        .then(products => {
            products.forEach(product => {
                const option = document.createElement('option');
                option.value = product.ProductID; // Set the value to the product ID
                option.textContent = product.Name; // Set the text to the product name
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            const errorMessage = document.createElement('p');
            errorMessage.textContent = "Failed to load products. Please try again.";
            form.appendChild(errorMessage);
        });
}

function submit_button(form) {
    // Add a submit button to the form
    const submitButton = document.createElement('button');
    submitButton.type = 'submit';
    submitButton.textContent = 'Submit';
    form.appendChild(submitButton);
}