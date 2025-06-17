<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Keranjang Belanja - RB Gallery</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <style>
      /* Global Styles */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      body {
        font-family: "Poppins", sans-serif;
        background-color: #f1f5f9;
        color: #1f2937;
        line-height: 1.6;
      }

      /* Header Styles */
      .header {
        background-color: white;
        padding: 20px 0;
        color: #333;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
      }
      .header h1 a {
        color: #333;
        text-decoration: none;
      }
      .header nav a {
        color: #333;
        text-decoration: none;
        margin: 0 20px;
        font-weight: 600;
      }
      .header nav a:hover {
        text-decoration: underline;
      }
      .cart-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 20px;
        color: #333;
        cursor: pointer;
        display: flex;
        align-items: center;
      }
      .cart-count {
        background-color: red;
        color: white;
        font-size: 14px;
        border-radius: 50%;
        padding: 5px 10px;
        margin-left: 5px;
      }

      /* Main Container */
      .container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 20px;
      }

      /* Cart Title */
      .cart-title {
        text-align: center;
        margin-bottom: 30px;
        color: #3b82f6;
      }

      /* Cart Content */
      .cart-content {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
      }

      /* Cart Items */
      .cart-items {
        flex: 1;
        min-width: 300px;
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }

      .cart-item {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #e5e7eb;
      }

      .cart-item:last-child {
        border-bottom: none;
      }

      .cart-item-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 15px;
      }

      .cart-item-details {
        flex: 1;
      }

      .cart-item-title {
        font-weight: 600;
        margin-bottom: 5px;
      }

      .cart-item-price {
      color: #3b82f6;
      font-weight: 600;
      font-size: 1.1rem;
      }

      .cart-item-price-original {
      color: #9ca3af;
      font-weight: 400;
      text-decoration: line-through;
      text-decoration-color: #ef4444;
      text-decoration-thickness: 2px;
      font-size: 0.9rem;
      margin-right: 0.5rem;
      position: relative;
      }

      .cart-item-quantity {
        display: flex;
        align-items: center;
        margin-top: 5px;
      }

      .quantity-btn {
        width: 25px;
        height: 25px;
        background-color: #e5e7eb;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .quantity-input {
        width: 40px;
        text-align: center;
        margin: 0 5px;
        border: 1px solid #d1d5db;
        border-radius: 3px;
        padding: 3px;
      }

      .remove-item {
        color: #ef4444;
        background: none;
        border: none;
        cursor: pointer;
        margin-left: 15px;
        font-size: 18px;
      }

      /* Cart Summary */
      .cart-summary {
        width: 300px;
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }

      .summary-title {
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 18px;
      }

      .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
      }

      .summary-total {
        font-weight: 600;
        font-size: 18px;
        margin: 20px 0;
        padding-top: 10px;
        border-top: 1px solid #e5e7eb;
      }
      .nav-links {
        display: flex;
        align-items: center;
        justify-content:  center;
        margin-top: 20px;
      }
      .nav-links a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
        margin-top: 10px;
      }
      .nav-links a:hover {
        text-decoration: underline;
      }
      .checkout-btn {
        width: 100%;
        padding: 12px;
        background-color: #3b82f6;
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
      }

      .checkout-btn:hover {
        background-color: #2563eb;
      }
      /* Empty Cart */
      .empty-cart {
        text-align: center;
        padding: 50px 0;
        width: 100%;
      }

      .empty-cart-icon {
        font-size: 50px;
        color: #d1d5db;
        margin-bottom: 20px;
      }

      .empty-cart-message {
        font-size: 18px;
        color: #6b7280;
        margin-bottom: 20px;
      }

      /* Footer */
      .footer {
        text-align: center;
        padding: 20px;
        background-color: #f8f8f8;
        margin-top: 50px;
      }

      .footer p {
        color: #6b7280;
        font-size: 14px;
      }

      .footer a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
      }

      .footer a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
<body>
<!-- Header Section -->
<header class="header">
  <h1><a href="../index.html">RB Gallery</a></h1>
  <nav>
  <a href="../index.html">Beranda</a>
  <a href="produk.php">Produk</a>
  <a href="../user/kontak.html">Kontak</a>
  </nav>
</header>

<!-- Main Content -->
<div class="container">
  <h1 class="cart-title">Keranjang Belanja Anda</h1>
    <div id="cartContainer">
    <div id="emptyCart" class="empty-cart">
    <div class="empty-cart-icon">
      <i class="fas fa-shopping-cart"></i>
    </div>
    <p class="empty-cart-message">Silahkan login terlebih dahulu</p>
    </div>   
    </div>
</div>

<!-- Footer -->
<footer class="footer">
  <p>© RB Gallery | <a href="#">Kebijakan Privasi</a></p>
</footer>
<input type="hidden" id="email" value="<?= $_COOKIE['email'] ?? 0; ?>">

<script>
document.addEventListener('DOMContentLoaded', () => {
// Ambil elemen-elemen yang diperlukan
const cartContainer = document.getElementById('cartContainer');
const emptyCartDiv = document.getElementById('emptyCart');
const email = document.getElementById('email').value;
  
// Cek apakah email ada dan tidak kosong
if (email && email !== '0') {
  emptyCartDiv.style.display = 'none';

  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      cartContainer.innerHTML = xhr.responseText;
    }
  }
  xhr.open('GET', `../include/getCart.php?email=${encodeURIComponent(email)}`, true);
  xhr.send();  
  } else {
    emptyCartDiv.style.display = 'block';
    alert('Silahkan login terlebih dahulu');
    return;
  }

// Fungsi untuk update quantity
document.addEventListener('click', function(e) {
  if (e.target.closest('.quantity-btn')) {
    const button = e.target.closest('.quantity-btn');
    const itemElement = button.closest('.cart-item');
    const quantityInput = itemElement.querySelector('.quantity-input');
    const id = itemElement.querySelector('#id_keranjang').value;
    let currentQuantity = parseInt(quantityInput.value);
    const change = parseInt(button.getAttribute('data-change'));
    const newQuantity = currentQuantity + change;

    if (newQuantity < 1) return;

    // Update UI immediately
    quantityInput.value = newQuantity;

    // 1.update the quantity
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../include/updateItem.php?id=${encodeURIComponent(id)}&change=${encodeURIComponent(newQuantity)}`, true);
    xhr.onload = () => {
    if (xhr.status === 200) {
        // Refresh cart after successful update
        const refreshXhr = new XMLHttpRequest();
        refreshXhr.open('GET', `../include/getCart.php?email=${encodeURIComponent(email)}`, true);
        refreshXhr.onload = () => {
          if (refreshXhr.status === 200) {
            cartContainer.innerHTML = refreshXhr.responseText; 
          } else {
            alert('Gagal memperbarui jumlah item');
          }
        }
        refreshXhr.send();
    } 
  }
    xhr.send();
  }
});

// Fungsi untuk menghapus item dari keranjang
document.addEventListener('click', function(e) {
  if (e.target.closest('#remove-item')) {
    const button = e.target.closest('#remove-item');
    const itemId = button.value;
        
    if (!confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
      return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../include/deleteItem.php?id=${encodeURIComponent(itemId)}`, true);
    xhr.onload = () => {
    if (xhr.status === 200) {
        // Refresh cart after successful deletion
        const refreshXhr = new XMLHttpRequest();
        refreshXhr.open('GET', `../include/getCart.php?email=${encodeURIComponent(email)}`, true);
        refreshXhr.onload = () => {
          if (refreshXhr.status === 200) {
            cartContainer.innerHTML = refreshXhr.responseText; 
          } else {
          alert('Gagal menghapus item');
          }  
        }
        refreshXhr.send();
    }
  }
  xhr.send();
}
});
});
</script>
</body>
</html>