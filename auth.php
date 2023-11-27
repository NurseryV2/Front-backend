<?php if (isset($_SESSION['status']) && $_SESSION['status'] == 1) : ?>
<!-- User is logged in -->
<a class="lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-gray-50 hover:bg-gray-100 text-sm text-gray-900 font-bold rounded-xl transition duration-200"
    href="#">Logout</a>
<a href="shoppingCart.php" class="relative">
    <p
        class="text-xl text-red absolute top-0 start-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-green-500 px-0.5 ">
        0</p>

    <svg class="h-8 p-1 hover:text-green-500 duration-200" aria-hidden="true" focusable="false" data-prefix="far"
        data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
        class="svg-inline--fa fa-shopping-cart fa-w-18 fa-7x">
        <path fill="currentColor"
            d="M551.991 64H144.28l-8.726-44.608C133.35 8.128 123.478 0 112 0H12C5.373 0 0 5.373 0 12v24c0 6.627 5.373 12 12 12h80.24l69.594 355.701C150.796 415.201 144 430.802 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-18.136-7.556-34.496-19.676-46.142l1.035-4.757c3.254-14.96-8.142-29.101-23.452-29.101H203.76l-9.39-48h312.405c11.29 0 21.054-7.869 23.452-18.902l45.216-208C578.695 78.139 567.299 64 551.991 64zM208 472c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm256 0c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm23.438-200H184.98l-31.31-160h368.548l-34.78 160z"
            class=""></path>
    </svg>
</a>
<?php else : ?>
<!-- User is not logged in -->
<a class="lg:inline-block lg:ml-auto py-2 px-6 bg-green-600 text-white hover:bg-green-700 text-sm font-bold rounded-xl transition duration-200"
    href="./login.php">Sign In</a>
<a class="lg:inline-block py-2 px-6 ml-2 bg-gray-50 hover:bg-gray-100 text-sm text-gray-900 font-bold rounded-xl transition duration-200"
    href="./signup.php">Sign Up</a>
<?php endif; ?>