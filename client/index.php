<?php
include("db.php");
// include("cart.php");
    session_start();
// $conn = new mysqli($servername, $username, $password, $dbname);

if ($_SESSION['LOGINEMAIL']) {
    $email = $_SESSION['LOGINEMAIL'];
    $query = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $SERRESULTU = $query->get_result();
    $row = $SERRESULTU->fetch_assoc();
    $IDuser = $row["user_id"];
}
// echo $IDuser;

$categoryToShow = "house";

if (isset($_GET['category'])) {
    $categoryToShow = $_GET['category'];
}
if (isset($_POST["basket"])) {
    $basket = $_POST["basket"];
    // echo $basket; // Insert into the basket table
    $qBasket = $conn->prepare("INSERT INTO basket (user_id, plant_id) VALUES (?, ?)");
    $qBasket->bind_param("ii", $IDuser, $basket);
    $qBasket->execute();


}

$sql = "SELECT * FROM plants WHERE category_id = (SELECT id FROM categories WHERE name = '$categoryToShow');";
$result = $conn->query($sql);
$matchingPlants = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['plant_name'])) {
        $plant_name = $_GET['plant_name'];
        $query = "SELECT * FROM plants WHERE name LIKE '%$plant_name%'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $matchingPlants[] = $row;
        }
    }
}

?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.9/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>

</head>

<body>
    <div class="  bg-cover bg-center h-screen ">

        <?php
        include("navbar.php");
        ?>

        <div class="max-w-screen-xl px-10 bg-transparent w-full h-screen py-10">
            <div class="backdrop-blur-sm bg-white w-full h-full p-10 mr-10 flex justify-around">
                <img src="../images/6.jpg" alt="" class="h-screen w-auto -ml-16 -mt-10">
                <div class="flex flex-col items-center justify-center">
                    <p class="font-semibold text-3xl lg:text-5xl xl:text-6xl text-black">PLANTS AND FLOWERS</p>
                    <span class="text-sm text-[#3c7b04] py-2">YOU THINK WE DESIGN</span>
                    <a href="#" id="but1"
                        class="border border-1 border-solid bg-black opacity-1 border-black rounded-full w-24 h-8 flex items-center justify-center">
                        <button class="text-white text-xl">Shop Now</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="flex flex-col items-center  mt-24">
            <svg xmlns="http://www.w3.org/2000/svg" width="54" height="55" viewBox="0 0 54 55" fill="none">
                <path
                    d="M29.0935 35.5185C31.9938 27.8983 39.6288 24.1487 45.8454 23.1624C36.7386 27.8669 32.1935 32.8702 28.975 43.0516L30.8302 43.5109C31.3483 41.5312 32.0679 39.7423 32.9374 38.0939C39.2891 40.2052 45.0796 39.5651 49.7954 34.5328C55.6539 27.2587 53.7062 19.3641 51.2458 11.4286C48.9033 19.0689 35.8448 17.9149 30.9458 26.864C29.9115 28.753 29.0443 30.6118 28.3496 32.4997"
                    fill="#7FB241" />
                <path
                    d="M31.3927 27.107C37.6864 19.1703 49.4794 19.4874 51.2458 11.4292C48.521 17.3476 39.4764 15.1101 33.2794 20.1696C29.688 23.2424 27.4842 27.0542 28.349 32.5009C29.0437 30.6124 30.0935 28.8247 31.3927 27.107Z"
                    fill="#719C40" />
                <path
                    d="M24.846 35.5185C21.9457 27.8983 14.3107 24.1487 8.09412 23.1624C17.2009 27.8669 21.7466 32.8702 24.9651 43.0516L23.1099 43.5109C22.5918 41.5312 21.8722 39.7423 21.0027 38.0939C14.6509 40.2052 8.86052 39.5651 4.14473 34.5328C-1.71386 27.2587 0.233867 19.3641 2.69431 11.4286C5.03679 19.0689 18.0953 17.9149 22.9943 26.864C24.0286 28.753 24.8958 30.6118 25.5905 32.4997"
                    fill="#7FB241" />
                <path
                    d="M22.5468 27.107C16.2537 19.1697 4.46067 19.4874 2.69373 11.4286C5.41853 17.347 14.4631 15.1095 20.6601 20.169C24.2515 23.2418 26.4553 27.0537 25.5905 32.5003C24.8958 30.6124 23.846 28.8247 22.5468 27.107Z"
                    fill="#719C40" />
            </svg>
            <h3 class="font-serif text-3xl mx-auto text-center mb-10">TRENDING PRODUCTS</h3>
        </div>
        <div id="categories" class=" flex justify-center items-center gap-4 my-5">

            <a href="?category=house"
                class=" border-2 border-solid bg-[#1f6200] opacity-1 border-gray-200 rounded-full w-32 h-8  flex items-center justify-center">
                <button class="text-white">House</button>
            </a>
            <a href="?category=wedding"
                class=" border-2 border-solid  opacity-1 border-gray-200 rounded-full w-32 h-8  flex items-center justify-center  active:bg-[#6fd404]">
                <button class="text-gray-400 ">Wedding</button>
            </a>
            <a href="?category=love"
                class=" border-2 border-solid opacity-1 border-gray-200 rounded-full w-40 h-8  flex items-center justify-center active:bg-[#6fd404]">
                <button class="text-gray-400 ">Love</button>
            </a>
        </div>
        <div class="container mx-auto mt-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php foreach ($matchingPlants as $plant): ?>
                <div
                    class="swiper-slide w-72 bg-white shadow-md rounded-md duration-500 hover:scale-105 hover:shadow-xl">
                    <a href="#">
                        <img src="<?php echo $plant['image_url']; ?>" alt=" Product"
                            class="h-80 w-72 object-cover rounded-t-xl" />
                        <div class="px-4 py-3 w-72">
                            <span class="text-gray-400 mr-3 uppercase text-xs">Nursery</span>
                            <p class="text-lg font-bold text-black truncate block capitalize">
                                <?php echo $plant['name']; ?>
                            </p>

                        </div>

                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <section
            class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">

            <?php
            while ($row = $result->fetch_assoc()) {
                ?>

            <div class="swiper-slide w-72 bg-white shadow-md rounded-md duration-500 hover:scale-105 hover:shadow-xl">
                <a href="#">
                    <img src="<?php echo $row['image_url']; ?>" alt=" Product"
                        class="h-80 w-72 object-cover rounded-t-xl" />
                    <div class="px-4 py-3 w-72">
                        <span class="text-gray-400 mr-3 uppercase text-xs">Nursery</span>
                        <p class="text-lg font-bold text-black truncate block capitalize">
                            <?php echo $row['name']; ?>
                        </p>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-black cursor-auto my-3">
                                $
                                <?php echo $row['price']; ?>
                            </p>
                            <del>
                                <p class="text-sm text-gray-600 cursor-auto ml-2">
                                    $
                                    <?php echo $row['discounted_price']; ?>

                                </p>
                            </del>
                            <div class="ml-auto">
                                <form action="" method="POST">
                                    <button type="submit" name="basket" value="<?php echo $row['id']; ?>">
                                        <svg xmlns=" http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-bag-plus hover:text-green-500 duration-200"
                                            viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                            <path
                                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                        </svg>

                                    </button>



                                </form>
                                </form>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            }
            ?>

        </section>
        <!-- wedding cards -->
        <div class=" flex flex-col items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="54" height="55" viewBox="0 0 54 55" fill="none">
                <path
                    d="M29.0935 35.5185C31.9938 27.8983 39.6288 24.1487 45.8454 23.1624C36.7386 27.8669 32.1935 32.8702 28.975 43.0516L30.8302 43.5109C31.3483 41.5312 32.0679 39.7423 32.9374 38.0939C39.2891 40.2052 45.0796 39.5651 49.7954 34.5328C55.6539 27.2587 53.7062 19.3641 51.2458 11.4286C48.9033 19.0689 35.8448 17.9149 30.9458 26.864C29.9115 28.753 29.0443 30.6118 28.3496 32.4997"
                    fill="#7FB241" />
                <path
                    d="M31.3927 27.107C37.6864 19.1703 49.4794 19.4874 51.2458 11.4292C48.521 17.3476 39.4764 15.1101 33.2794 20.1696C29.688 23.2424 27.4842 27.0542 28.349 32.5009C29.0437 30.6124 30.0935 28.8247 31.3927 27.107Z"
                    fill="#719C40" />
                <path
                    d="M24.846 35.5185C21.9457 27.8983 14.3107 24.1487 8.09412 23.1624C17.2009 27.8669 21.7466 32.8702 24.9651 43.0516L23.1099 43.5109C22.5918 41.5312 21.8722 39.7423 21.0027 38.0939C14.6509 40.2052 8.86052 39.5651 4.14473 34.5328C-1.71386 27.2587 0.233867 19.3641 2.69431 11.4286C5.03679 19.0689 18.0953 17.9149 22.9943 26.864C24.0286 28.753 24.8958 30.6118 25.5905 32.4997"
                    fill="#7FB241" />
                <path
                    d="M22.5468 27.107C16.2537 19.1697 4.46067 19.4874 2.69373 11.4286C5.41853 17.347 14.4631 15.1095 20.6601 20.169C24.2515 23.2418 26.4553 27.0537 25.5905 32.5003C24.8958 30.6124 23.846 28.8247 22.5468 27.107Z"
                    fill="#719C40" />
            </svg>
            <h3 class="font-serif text-3xl mx-auto text-center mb-10">TRENDING BLOGS</h3>
        </div>


        <section id="blogs" class="  text-gray-800 my-8 ">
            <div class="container mx-auto space-y-8  ">
                <div class=" gap-x-4 gap-y-8  flex justify-center items-center ">
                    <article
                        class="flex flex-col bg-gray-50 swiper-slide w-72  shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                        <a rel="noopener noreferrer" href="#" aria-label="Te nulla oportere reprimique his dolorum">
                            <img alt="" class="object-cover w-full h-52 bg-gray-500" src="../images/9.jpg">
                        </a>
                        <div class="flex flex-col flex-1">

                            <div class="flex flex-wrap justify-between pt-3 space-x-2 text-xs text-gray-600">
                                <span>June 2, 2020</span>
                                <div class="flex">

                                    <svg fill="#6fd404" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 442.04 442.04"
                                        xml:space="preserve" stroke="#6fd404">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g>
                                                <g>
                                                    <path d="M221.02,341.304c-49.708,0-103.206-19.44-154.71-56.22C27.808,257.59,4.044,230.351,
                                    3.051,229.203 c-4.068-4.697-4.068-11.669,0-16.367c0.993-1.146,24.756-28.387,63.259-55.881c51.
                                    505-36.777,105.003-56.219,154.71-56.219 c49.708,0,103.207,19.441,154.71,56.219c38.502,27.494,
                                    62.266,54.734,63.259,55.881c4.068,4.697,4.068,11.669,0,16.367 c-0.993,1.146-24.756,28.387-63.259
                                    ,55.881C324.227,321.863,270.729,341.304,221.02,341.304z M29.638,221.021 c9.61,9.799,27.747,27.03
                                    ,51.694,44.071c32.83,23.361,83.714,51.212,139.688,51.212s106.859-27.851,139.688-51.212 c23.944-17.038
                                    ,42.082-34.271,51.694-44.071c-9.609-9.799-27.747-27.03-51.694-44.071 c-32.829-23.362-83.714-51.212-139.688-
                                    51.212s-106.858,27.85-139.688,51.212C57.388,193.988,39.25,211.219,29.638,221.021z">
                                                    </path>
                                                </g>
                                                <g>
                                                    <path d="M221.02,298.521c-42.734,0-77.5-34.767-77.5-77.5c0-42.733,34.766-77.5,77.5-77.5c18.794,0,36.924,6.814,51.04
                                    8,19.188 c5.193,4.549,5.715,12.446,1.166,17.639c-4.549,5.193-12.447,5.714-17.639,1.166c-9.564-8.379-21.844-12.993-34.57
                                    6-12.993 c-28.949,0-52.5,23.552-52.5,52.5s23.551,52.5,52.5,52.5c28.95,0,52.5-23.552,52.5-52.5c0-6.903,5.597-12.5,12.5-1
                                    2.5 s12.5,5.597,12.5,12.5C298.521,263.754,263.754,298.521,221.02,298.521z"></path>
                                                </g>
                                                <g>
                                                    <path d="M221.02,246.021c-13.785,0-25-11.215-2
                                    5-25s11.21
                                    5-25,25-25c13
                                    .786,0,25,11.215,25,25S234.806,246.021,221.02,246.021z"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <span>2.2&Kappa; </span>

                                </div>
                            </div>
                    </article>
                    <article
                        class="flex flex-col bg-gray-50 swiper-slide w-72  shadow-md rounded-md duration-500 hover:scale-105 hover:shadow-xl">
                        <a rel="noopener noreferrer" href="#" aria-label="Te nulla oportere reprimique his dolorum">
                            <img alt="" class="object-cover w-full h-52 bg-gray-500" src="../images/9.jpg">
                        </a>
                        <div class="flex flex-col flex-1">

                            <div class="backdrop-blur-sm bg-white/30 flex flex-wrap justify-between pt-3
                                space-x-2 text-xs text-gray-600">
                                <span>June 2, 2020</span>
                                <span>2.2K views</span>
                            </div>
                        </div>
                    </article>
                    <article
                        class="flex flex-col bg-gray-50 swiper-slide w-72  shadow-md rounded-md duration-500 hover:scale-105 hover:shadow-xl">

                        <a rel="noopener noreferrer" href="#" aria-label="Te nulla oportere reprimique his dolorum">
                            <img alt="" class="object-cover w-full h-52 bg-gray-500" src="../images/11.jpg">
                        </a>
                        <div class="flex flex-col flex-1">
                            <div class="flex flex-wrap justify-between pt-3 space-x-2 text-xs text-gray-600">
                                <span>June 2, 2020</span>
                                <span>2.2K views</span>
                            </div>
                        </div>
                    </article>


                </div>
            </div>
        </section>


        <main id="faq" class=" p-5 bg-light-blue -mt-20">
            <div class="flex justify-center items-start my-2">
                <div class="w-full sm:w-10/12 md:w-1/2 my-1">
                    <div class="flex flex-col items-center  mt-24">
                        <svg xmlns="http://www.w3.org/2000/svg" width="54" height="55" viewBox="0 0 54 55" fill="none">
                            <path
                                d="M29.0935 35.5185C31.9938 27.8983 39.6288 24.1487 45.8454 23.1624C36.7386 27.8669 32.1935 32.8702 28.975 43.0516L30.8302 43.5109C31.3483 41.5312 32.0679 39.7423 32.9374 38.0939C39.2891 40.2052 45.0796 39.5651 49.7954 34.5328C55.6539 27.2587 53.7062 19.3641 51.2458 11.4286C48.9033 19.0689 35.8448 17.9149 30.9458 26.864C29.9115 28.753 29.0443 30.6118 28.3496 32.4997"
                                fill="#7FB241" />
                            <path
                                d="M31.3927 27.107C37.6864 19.1703 49.4794 19.4874 51.2458 11.4292C48.521 17.3476 39.4764 15.1101 33.2794 20.1696C29.688 23.2424 27.4842 27.0542 28.349 32.5009C29.0437 30.6124 30.0935 28.8247 31.3927 27.107Z"
                                fill="#719C40" />
                            <path
                                d="M24.846 35.5185C21.9457 27.8983 14.3107 24.1487 8.09412 23.1624C17.2009 27.8669 21.7466 32.8702 24.9651 43.0516L23.1099 43.5109C22.5918 41.5312 21.8722 39.7423 21.0027 38.0939C14.6509 40.2052 8.86052 39.5651 4.14473 34.5328C-1.71386 27.2587 0.233867 19.3641 2.69431 11.4286C5.03679 19.0689 18.0953 17.9149 22.9943 26.864C24.0286 28.753 24.8958 30.6118 25.5905 32.4997"
                                fill="#7FB241" />
                            <path
                                d="M22.5468 27.107C16.2537 19.1697 4.46067 19.4874 2.69373 11.4286C5.41853 17.347 14.4631 15.1095 20.6601 20.169C24.2515 23.2418 26.4553 27.0537 25.5905 32.5003C24.8958 30.6124 23.846 28.8247 22.5468 27.107Z"
                                fill="#719C40" />
                        </svg>
                        <h3 class="font-serif text-3xl mx-auto text-center mb-10">FAQ</h3>
                    </div>
                    <ul class="flex flex-col items-center justify-center">
                        <li class="bg-white my-2 shadow-lg w-[80vw] " x-data="accordion(1)">
                            <h2 @click="handleClick()"
                                class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                                <span>When will my order arrive?</span>
                                <svg :class="handleRotate()"
                                    class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                    </path>
                                </svg>
                            </h2>
                            <div x-ref="tab" :style="handleToggle()"
                                class="border-l-2 border-green-600 overflow-hidden max-h-0 duration-500 transition-all">
                                <p class="p-3 text-gray-900">
                                    Shipping time is set by our delivery partners, according to the
                                    delivery method
                                    chosen by you. Additional details can be found in the order
                                    confirmation
                                </p>
                            </div>
                        </li>
                        <li class="bg-white my-2 shadow-lg  w-[80vw]" x-data="accordion(2)">
                            <h2 @click="handleClick()"
                                class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                                <span>How do I track my order?</span>
                                <svg :class="handleRotate()"
                                    class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                    </path>
                                </svg>
                            </h2>
                            <div class="border-l-2 border-green-600 overflow-hidden max-h-0 duration-500 transition-all"
                                x-ref="tab" :style="handleToggle()">
                                <p class="p-3 text-gray-900">
                                    Once shipped, you’ll get a confirmation email that includes a
                                    tracking number
                                    and additional information regarding tracking your order.
                                </p>
                            </div>
                        </li>
                        <li class="bg-white my-2 shadow-lg  w-[80vw]" x-data="accordion(3)">
                            <h2 @click="handleClick()"
                                class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                                <span>What’s your return policy?</span>
                                <svg :class="handleRotate()"
                                    class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                    </path>
                                </svg>
                            </h2>
                            <div class="border-l-2 border-green-600 overflow-hidden max-h-0 duration-500 transition-all"
                                x-ref="tab" :style="handleToggle()">
                                <p class="p-3 text-gray-900">
                                    We allow the return of all items within 30 days of your original
                                    order’s date.
                                    If you’re interested in returning your items, send us an email
                                    with your order
                                    number and we’ll ship a return label.
                                </p>
                            </div>
                        </li>
                        <li class="bg-white my-2 shadow-lg  w-[80vw]" x-data="accordion(4)">
                            <h2 @click="handleClick()"
                                class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                                <span>How do I make changes to an existing order?</span>
                                <svg :class="handleRotate()"
                                    class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                    </path>
                                </svg>
                            </h2>
                            <div class="border-l-2 border-green-600 overflow-hidden max-h-0 duration-500 transition-all"
                                x-ref="tab" :style="handleToggle()">
                                <p class="p-3 text-gray-900">
                                    Changes to an existing order can be made as long as the order is
                                    still in
                                    “processing” status. Please contact our team via email and we’ll
                                    make sure to
                                    apply the needed changes. If your order has already been
                                    shipped, we cannot
                                    apply any changes to it. If you are unhappy with your order when
                                    it arrives,
                                    please contact us for any changes you may require.
                                </p>
                            </div>
                        </li>
                        <li class="bg-white my-2 shadow-lg  w-[80vw]" x-data="accordion(5)">
                            <h2 @click="handleClick()"
                                class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                                <span>What shipping options do you have?</span>
                                <svg :class="handleRotate()"
                                    class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                    </path>
                                </svg>
                            </h2>
                            <div class="border-l-2 border-green-600 overflow-hidden max-h-0 duration-500 transition-all"
                                x-ref="tab" :style="handleToggle()">
                                <p class="p-3 text-gray-900">
                                    For USA domestic orders we offer FedEx and USPS shipping.
                                </p>
                            </div>
                        </li>
                        <li class="bg-white my-2 shadow-lg  w-[80vw]" x-data="accordion(6)">
                            <h2 @click="handleClick()"
                                class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                                <span>What payment methods do you accept?</span>
                                <svg :class="handleRotate()"
                                    class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                    </path>
                                </svg>
                            </h2>
                            <div class="border-l-2 border-green-600 overflow-hidden max-h-0 duration-500 transition-all"
                                x-ref="tab" :style="handleToggle()">
                                <p class="p-3 text-gray-900">
                                    Any method of payments acceptable by you. For example: We accept
                                    MasterCard,
                                    Visa, American Express, PayPal, JCB Discover, Gift Cards, etc.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
        <div class="flex flex-col items-center  mt-24">
            <svg xmlns="http://www.w3.org/2000/svg" width="54" height="55" viewBox="0 0 54 55" fill="none">
                <path
                    d="M29.0935 35.5185C31.9938 27.8983 39.6288 24.1487 45.8454 23.1624C36.7386 27.8669 32.1935 32.8702 28.975 43.0516L30.8302 43.5109C31.3483 41.5312 32.0679 39.7423 32.9374 38.0939C39.2891 40.2052 45.0796 39.5651 49.7954 34.5328C55.6539 27.2587 53.7062 19.3641 51.2458 11.4286C48.9033 19.0689 35.8448 17.9149 30.9458 26.864C29.9115 28.753 29.0443 30.6118 28.3496 32.4997"
                    fill="#7FB241" />
                <path
                    d="M31.3927 27.107C37.6864 19.1703 49.4794 19.4874 51.2458 11.4292C48.521 17.3476 39.4764 15.1101 33.2794 20.1696C29.688 23.2424 27.4842 27.0542 28.349 32.5009C29.0437 30.6124 30.0935 28.8247 31.3927 27.107Z"
                    fill="#719C40" />
                <path
                    d="M24.846 35.5185C21.9457 27.8983 14.3107 24.1487 8.09412 23.1624C17.2009 27.8669 21.7466 32.8702 24.9651 43.0516L23.1099 43.5109C22.5918 41.5312 21.8722 39.7423 21.0027 38.0939C14.6509 40.2052 8.86052 39.5651 4.14473 34.5328C-1.71386 27.2587 0.233867 19.3641 2.69431 11.4286C5.03679 19.0689 18.0953 17.9149 22.9943 26.864C24.0286 28.753 24.8958 30.6118 25.5905 32.4997"
                    fill="#7FB241" />
                <path
                    d="M22.5468 27.107C16.2537 19.1697 4.46067 19.4874 2.69373 11.4286C5.41853 17.347 14.4631 15.1095 20.6601 20.169C24.2515 23.2418 26.4553 27.0537 25.5905 32.5003C24.8958 30.6124 23.846 28.8247 22.5468 27.107Z"
                    fill="#719C40" />
            </svg>
            <h3 class="font-serif text-3xl mx-auto text-center mb-10">Contact Us</h3>
        </div>
        <div id="contact" class="container my-24 mx-auto md:px-6">
            <section class="mb-32">
                <div
                    class="relative h-[300px] overflow-hidden bg-cover bg-[50%] bg-no-repeat bg-[url('../images/mn.jpg')]">
                </div>
                <div class="container px-6 md:px-12">
                    <div
                        class="block rounded-lg bg-[hsla(0,0%,100%,0.7)] px-6 py-12 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-[hsla(0,0%,5%,0.7)] dark:shadow-black/20 md:py-16 md:px-12 -mt-[100px] backdrop-blur-[30px]">
                        <div class="mb-12 grid gap-x-6 md:grid-cols-2 lg:grid-cols-4">
                            <div class="mx-auto mb-12 text-center lg:mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="black" class="mx-auto mb-6 h-8 w-8 text-primary dark:text-primary-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 01-1.161.886l-.143.048a1.107 1.107 0 00-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 01-1.652.928l-.679-.906a1.125 1.125 0 00-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 00-8.862 12.872M12.75 3.031a9 9 0 016.69 14.036m0 0l-.177-.529A2.25 2.25 0 0017.128 15H16.5l-.324-.324a1.453 1.453 0 00-2.328.377l-.036.073a1.586 1.586 0 01-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 01-5.276 3.67m0 0a9 9 0 01-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                                </svg>

                                <h6 class="font-medium">Unites States</h6>
                            </div>
                            <div class="mx-auto mb-12 text-center lg:mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="black" class="mx-auto mb-6 h-8 w-8 text-primary dark:text-primary-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <h6 class="font-medium ">New York, 94126</h6>
                            </div>
                            <div class="mx-auto mb-6 text-center md:mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="black" class=" mx-auto mb-6 h-8 w-8 text-primary dark:text-primary-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                <h6 class="font-medium">+ 01 234 567 89</h6>
                            </div>
                            <div class="mx-auto text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="black" class="mx-auto mb-6 h-8 w-8 text-primary dark:text-primary-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                </svg>
                                <h6 class="font-medium">Tax ID: 273 384</h6>
                            </div>
                        </div>
                        <div class="mx-auto max-w-[700px]">
                            <form>
                                <div class="relative mb-6" data-te-input-wrapper-init>
                                    <input type="text"
                                        class="peer block min-h-[auto] w-full rounded border border-gray-500 bg-transparent py-[0.32rem] px-3 leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        id="exampleInput90" placeholder="Name" />
                                    <label
                                        class="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                                        for="exampleInput90">Name
                                    </label>

                                </div>
                                <div class="relative mb-6" data-te-input-wrapper-init>
                                    <input type="email"
                                        class="peer block min-h-[auto] w-full rounded border border-gray-500 bg-transparent py-[0.32rem] px-3 leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        id="exampleInput91" placeholder="Email address" />
                                    <label
                                        class="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                                        for="exampleInput91">Email address
                                    </label>
                                </div>
                                <div class="relative mb-6" data-te-input-wrapper-init>
                                    <textarea
                                        class="peer block min-h-[auto] w-full rounded border border-gray-500 bg-transparent py-[0.32rem] px-3 leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        id="exampleFormControlTextarea1" rows="3" placeholder="Your message"></textarea>
                                    <label for="exampleFormControlTextarea1"
                                        class="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Message</label>
                                </div>
                                <div class="mb-6 inline-block min-h-[1.5rem] justify-center pl-[1.5rem] md:flex">
                                    <input
                                        class="relative float-left mt-[0.15rem] mr-[6px] -ml-[1.5rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:ml-[0.25rem] checked:after:-mt-px checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-t-0 checked:after:border-l-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:ml-[0.25rem] checked:focus:after:-mt-px checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-t-0 checked:focus:after:border-l-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:checked:border-primary dark:checked:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
                                        type="checkbox" value="" id="exampleCheck96" checked />
                                    <label class="inline-block pl-[0.15rem] hover:cursor-pointer" for="exampleCheck96">
                                        Send me a copy of this message
                                    </label>
                                </div>
                                <button type="button" data-te-ripple-init data-te-ripple-color="light"
                                    class="inline-block w-full rounded bg-green-800 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] lg:mb-0">
                                    Send
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="bg-white dark:bg-gray-900">
            <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                <div class="md:flex md:justify-between">

                    <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">

                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                                Follow us
                            </h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Github</a>
                                </li>
                                <li>
                                    <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Discord</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                                Legal
                            </h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <a href="#" class="hover:underline">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-500 text-center dark:text-gray-400 mx-auto">©
                        2023 <a href="" class="hover:underline">Hariti</a>. All Rights Reserved.
                    </span>
                    <div class="flex mt-4 sm:justify-center sm:mt-0">
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 8 19">
                                <path fill-rule="evenodd"
                                    d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Facebook page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 21 16">
                                <path
                                    d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                            </svg>
                            <span class="sr-only">Discord community</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 17">
                                <path fill-rule="evenodd"
                                    d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Twitter page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">GitHub account</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0
                                     0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only ">Dribbble account</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>


        <?php
        $conn->close();
        ?>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('navbar-toggle');
            const searchButton = document.getElementById('search-toggle');
            const menu = document.getElementById('navbar-search');

            searchButton.addEventListener('click', function() {
                menu.classList.toggle('hidden');
            });

            button.addEventListener('click', function() {
                menu.classList.toggle('hidden');
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            // open
            const burger = document.querySelectorAll('.navbar-burger');
            const menu = document.querySelectorAll('.navbar-menu');

            if (burger.length && menu.length) {
                for (var i = 0; i < burger.length; i++) {
                    burger[i].addEventListener('click', function() {
                        for (var j = 0; j < menu.length; j++) {
                            menu[j].classList.toggle('hidden');
                        }
                    });
                }
            }

            // close
            const close = document.querySelectorAll('.navbar-close');
            const backdrop = document.querySelectorAll('.navbar-backdrop');

            if (close.length) {
                for (var i = 0; i < close.length; i++) {
                    close[i].addEventListener('click', function() {
                        for (var j = 0; j < menu.length; j++) {
                            menu[j].classList.toggle('hidden');
                        }
                    });
                }
            }

            if (backdrop.length) {
                for (var i = 0; i < backdrop.length; i++) {
                    backdrop[i].addEventListener('click', function() {
                        for (var j = 0; j < menu.length; j++) {
                            menu[j].classList.toggle('hidden');
                        }
                    });
                }
            }
        });
        document.addEventListener('alpine:init', () => {
            Alpine.store('accordion', {
                tab: 0
            });

            Alpine.data('accordion', (idx) => ({
                init() {
                    this.idx = idx;
                },
                idx: -1,
                handleClick() {
                    this.$store.accordion.tab = this.$store.accordion.tab ===
                        this.idx ? 0 : this
                        .idx;
                },
                handleRotate() {
                    return this.$store.accordion.tab === this.idx ?
                        'rotate-180' : '';
                },
                handleToggle() {
                    return this.$store.accordion.tab === this.idx ?
                        `max-height: ${this.$refs.tab.scrollHeight}px` : '';
                }
            }));
        })
        </script>
</body>

</html>