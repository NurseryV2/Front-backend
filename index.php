<?php
include("db.php");

$categoryToShow = "house";

if (isset($_GET['category'])) {
    $categoryToShow = $_GET['category'];
}

// Query based on the selected category
$sql = "SELECT * FROM plants WHERE category_id = (SELECT id FROM categories WHERE name = '$categoryToShow');";
$result = $conn->query($sql);

?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-black bg-cover bg-center h-screen ">
        <div class="backdrop-blur-sm bg-white/30 flex justify-between w-full h-10 items-center">
            <div class="px-10">logo</div>
            <div class="text-sm lg:flex-grow text-center  ">
                <a href="#responsive-header"
                    class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4">
                    Docs
                </a>
                <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4">
                    Examples
                </a>
                <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white">
                    Blog
                </a>
            </div>
            <div class="flex pr-10">

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path
                        d="M17.5 17.5L13.7617 13.755L17.5 17.5ZM15.8333 8.74996C15.8333 10.6286 15.0871 12.4303 13.7587 13.7586C12.4303 15.087 10.6286 15.8333 8.75 15.8333C6.87138 15.8333 5.06971 15.087 3.74132 13.7586C2.41294 12.4303 1.66666 10.6286 1.66666 8.74996C1.66666 6.87134 2.41294 5.06967 3.74132 3.74129C5.06971 2.4129 6.87138 1.66663 8.75 1.66663C10.6286 1.66663 12.4303 2.4129 13.7587 3.74129C15.0871 5.06967 15.8333 6.87134 15.8333 8.74996V8.74996Z"
                        stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="26" viewBox="0 0 32 26" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.761905 0.80957C0.341116 0.80957 0 1.15069 0 1.57148C0 1.99226 0.341116 2.33338 0.761905 2.33338H3.6726L8.92402 20.0735C8.92497 20.0767 8.92595 20.0799 8.92694 20.0831L9.04918 20.6191H26.501C26.5033 20.6191 26.5056 20.6191 26.5078 20.6191H26.6667C26.8059 20.6191 26.9363 20.5818 27.0486 20.5166C27.4215 20.3714 27.7261 20.0809 27.8776 19.7016L31.8982 9.62751C32.2747 8.68407 31.5605 7.66673 30.5216 7.66673H6.84055L4.97222 1.35521C4.87642 1.0316 4.57914 0.80957 4.24165 0.80957H0.761905ZM14.2019 23.2401C14.2019 24.3173 13.3287 25.1905 12.2514 25.1905C11.1742 25.1905 10.301 24.3173 10.301 23.2401C10.301 22.1629 11.1742 21.2896 12.2514 21.2896C13.3287 21.2896 14.2019 22.1629 14.2019 23.2401ZM20.7035 25.1905C21.7807 25.1905 22.654 24.3173 22.654 23.2401C22.654 22.1629 21.7807 21.2896 20.7035 21.2896C19.6263 21.2896 18.753 22.1629 18.753 23.2401C18.753 24.3173 19.6263 25.1905 20.7035 25.1905Z"
                        fill="white" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="30" viewBox="0 0 22 30" fill="none">
                    <circle cx="11" cy="7" r="5" stroke="white" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <ellipse cx="11" cy="22.5" rx="9" ry="5.5" stroke="white" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>

        </div>

        <div class="max-w-screen-xl px-10 bg-transparent w-full h-screen py-10">
            <div class="backdrop-blur-sm bg-white w-full h-full p-10 mr-10 flex justify-around">
                <img src="./images/6.jpg" alt="" class="h-2/3 w-96 -ml-10">
                <div class="flex flex-col items-center justify-center ">
                    <p class=" font-semibold text-2xl text-black ">PLANTS AND FLOWERS</p>
                    <span class="text-sm text-[#3c7b04] py-2">YOU
                        THINK
                        WE
                        DESIGN</span>
                    <a href="#" id="but1"
                        class="border border-1 border-solid bg-black opacity-1 border-black rounded-full w-24 h-8  flex items-center justify-center">
                        <button class="text-white">Shop Now</button>
                    </a>
                    <div class="flex justify-between w-6">
                        <p class="text-md font-bold text-[#a6f31f]">1</p>
                        <p>2</p>

                    </div>
                </div>

            </div>
        </div>
        <h3 class="font-serif text-3xl mx-auto text-center my-5 ">TRENDING PRODUCT</h3>
        <div class=" flex justify-center items-center gap-4 my-5">

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

        <section id="house-products"
            class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">

            <?php
    while ($row = $result->fetch_assoc()) {
        ?>

            <div class="swiper-slide w-72 bg-white shadow-md rounded-md duration-500 hover:scale-105 hover:shadow-xl">
                <a href="#">
                    <img src="<?php echo $row['image_url']; ?>" alt="Product"
                        class="h-80 w-72 object-cover rounded-t-xl" />
                    <div class="px-4 py-3 w-72">
                        <span class="text-gray-400 mr-3 uppercase text-xs">Nursery</span>
                        <p class="text-lg font-bold text-black truncate block capitalize">
                            <?php echo $row['name']; ?>
                        </p>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-black cursor-auto my-3">
                                $<?php echo $row['price']; ?>
                            </p>
                            <del>
                                <p class="text-sm text-gray-600 cursor-auto ml-2">
                                    $<?php echo $row['discounted_price']; ?>

                                </p>
                            </del>
                            <div class="ml-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg></div>
                        </div>
                    </div>
                </a>
            </div>

            <?php
    }
    ?>

        </section>
        <!-- wedding cards -->


        <h3 class="font-serif text-3xl mx-auto text-center mt-16 mb-10 ">TRENDING BLOGS</h3>
        <section class="  text-gray-800 my-8 ">
            <div class="container mx-auto space-y-8  ">
                <div class=" gap-x-4 gap-y-8  flex justify-center items-center ">
                    <article
                        class="flex flex-col bg-gray-50 swiper-slide w-72  shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                        <a rel="noopener noreferrer" href="#" aria-label="Te nulla oportere reprimique his dolorum">
                            <img alt="" class="object-cover w-full h-52 bg-gray-500" src="./images/9.jpg">
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
                            <img alt="" class="object-cover w-full h-52 bg-gray-500" src="./images/9.jpg">
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
                            <img alt="" class="object-cover w-full h-52 bg-gray-500" src="./images/11.jpg">
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
        <!--Carousel-->
        <div id="carouselExampleCaptions" class="relative" data-te-carousel-init data-te-carousel-slide>
            <div class="relative w-full overflow-hidden after:clear-both after:block after:content-['']">
                <!--First Testimonial / Carousel item-->
                <div class="relative float-left -mr-[100%] hidden w-full text-center transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                    data-te-carousel-active data-te-carousel-item style="backface-visibility: hidden">
                    <p class="mx-auto max-w-4xl text-xl italic text-neutral-700 dark:text-neutral-300">
                        "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit,
                        error amet numquam iure provident voluptate esse quasi, voluptas
                        nostrum quisquam!"
                    </p>
                    <div class="mb-6 mt-12 flex justify-center">
                        <img src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20(2).webp"
                            class="h-24 w-24 rounded-full shadow-lg dark:shadow-black/30" alt="smaple image" />
                    </div>
                    <p class="text-neutral-500 dark:text-neutral-300">- Anna Morian</p>
                </div>



                <!--Third Testimonial / Carousel item-->
                <div class="relative float-left -mr-[100%] hidden w-full text-center transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                    data-te-carousel-item style="backface-visibility: hidden">
                    <p class="mx-auto max-w-4xl text-xl italic text-neutral-700 dark:text-neutral-300">
                        "Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur est laborum neque
                        cupiditate assumenda in maiores."
                    </p>
                    <div class="mb-6 mt-12 flex justify-center">
                        <img src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                            class="h-24 w-24 rounded-full shadow-lg dark:shadow-black/30" alt="smaple image" />
                    </div>
                    <p class="text-neutral-500 dark:text-neutral-300">- Kate Allise</p>
                </div>
            </div>
            <footer class="bg-white dark:bg-gray-900">
                <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                    <div class="md:flex md:justify-between">
                        <!-- <div class="mb-6 md:mb-0">
                        <a href="https://flowbite.com/" class="flex items-center">
                            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                            <span
                                class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
                        </a>
                    </div> -->
                        <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">

                            <div>
                                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us
                                </h2>
                                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                    <li class="mb-4">
                                        <a href="https://github.com/themesberg/flowbite"
                                            class="hover:underline ">Github</a>
                                    </li>
                                    <li>
                                        <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Discord</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal
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
                        <span class="text-sm text-gray-500 text-center dark:text-gray-400 mx-auto">© 2023 <a href=""
                                class="hover:underline">Hariti</a>. All Rights Reserved.
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
            </script>
</body>

</html>