<?php
$pageTitle = "TaskHive | Home";
require "header.php";
?>

<body class="font-dmsans ">
    <main class="min-h-dvh  bg-[#fdfaf3b3] py-10 relative main-bg ">
        <nav class="bg-white relative w-[88%] mx-auto rounded-3xl px-6 flex  items-center justify-between py-3 shadow-sm md:w-5/6 lg:w-[80%] ">

            <h4 class="text-4xl rounded-tr-3xl rounded-bl-3xl px-2 py-1 bg-black text-white w-fit font-extrabold">T <span class="text-base -ml-2  bg-white text-black px-1">h</span></h4>

            <div class="flex items-center space-x-2">
                <a href="./login" class="border-[2px]  border-black text-black  px-6 py-2  rounded-3xl text-center hover:bg-amber-100 hover:border-amber-200 active:opacity-30">
                    Log in
                </a>

                <a href="./signup" class="text-white bg-black px-6 py-2 border-[2px] border-transparent rounded-3xl text-center hover:bg-amber-100 hover:text-slate-800 hover:border-amber-200 ">
                    Sign up
                </a>
            </div>

        </nav>

        <section class="relative flex flex-col items-center justify-center mt-14 ">
            <h1 class="text-4xl tracking-wide font-bold text-center mb-6 text-wrap px-2 md:text-5xl lg:text-6xl md:w-5/6 lg:w-4/6">
                Revolutionalize your Productivity with TasK hiVe
            </h1>

            <p class=" text-center w-[98%]  text-slate-600 mb-8 md:w-5/6 lg:w-4/6">
                Whether you're managing personal projects or striving to achieve your goals independently, Task Hive empowers you to work efficiently. Experience seamless task organization and enhanced productivity with Task Hive today.
            </p>
            <div class="flex flex-col pb-8 items-center">
                <img src="<?php echo $filePath ?>/assets/tasklist.png" alt="task hive" class="w-[300px] mb-4" />

                <a href="./login" class="bg-black rounded-tr-3xl border-[2px] border-transparent rounded-br-3xl text-white px-6 py-2 text-lg transition-all ease-in-out duration-150 hover:shadow-md hover:translate-x-2 hover:bg-amber-100 hover:text-black hover:border-amber-300 active:opacity-10">Get Started ->></a>
            </div>

        </section>



        <div class="bg-gradient-to-r text-white from-black via-black/90 to-black w-fit px-6 py-2 shadow-sm rounded-md absolute bottom-10 right-10 hidden md:block">
            <div class="flex space-x-2 items-end justify-end">
                <svg class="w-6 h-6 text-amber-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8.597 3.2A1 1 0 0 0 7.04 4.289a3.49 3.49 0 0 1 .057 1.795 3.448 3.448 0 0 1-.84 1.575.999.999 0 0 0-.077.094c-.596.817-3.96 5.6-.941 10.762l.03.049a7.73 7.73 0 0 0 2.917 2.602 7.617 7.617 0 0 0 3.772.829 8.06 8.06 0 0 0 3.986-.975 8.185 8.185 0 0 0 3.04-2.864c1.301-2.2 1.184-4.556.588-6.441-.583-1.848-1.68-3.414-2.607-4.102a1 1 0 0 0-1.594.757c-.067 1.431-.363 2.551-.794 3.431-.222-2.407-1.127-4.196-2.224-5.524-1.147-1.39-2.564-2.3-3.323-2.788a8.487 8.487 0 0 1-.432-.287Z" />
                </svg>
            </div>
            <p class="font-semibold "> Stay on <span class="text-amber-500">Track</span> </p>
        </div>

    </main>
</body>

</html>