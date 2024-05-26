<?php
function matchesUrlEndPath($endPath)
{
    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    return substr($url, -strlen($endPath)) == $endPath;
}
?>

<body class="font-dmsans grid grid-cols-6 min-h-dvh ">
    <aside class="col-span-1 bg-white h-full px-8 pt-5 ">
        <h2 class="text-3xl font-semibold mb-8"><span class="text-amber-500">T</span>ask <span class="text-amber-500">H</span>ive</h2>
        <div class="py-4 pl-2 space-y-6">
            <a href="./dashboard " class="text-lg <?php echo matchesUrlEndPath("/dashboard") ? 'text-slate-800' : 'text-gray-600'; ?>   group flex hover:text-amber-300 ">
                <svg class="w-6 h-6  <?php echo matchesUrlEndPath("/dashboard") ? 'text-amber-500' : 'text-gray-600'; ?> dark:text-white group-hover:text-amber-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 17h6m-3 3v-6M4.857 4h4.286c.473 0 .857.384.857.857v4.286a.857.857 0 0 1-.857.857H4.857A.857.857 0 0 1 4 9.143V4.857C4 4.384 4.384 4 4.857 4Zm10 0h4.286c.473 0 .857.384.857.857v4.286a.857.857 0 0 1-.857.857h-4.286A.857.857 0 0 1 14 9.143V4.857c0-.473.384-.857.857-.857Zm-10 10h4.286c.473 0 .857.384.857.857v4.286a.857.857 0 0 1-.857.857H4.857A.857.857 0 0 1 4 19.143v-4.286c0-.473.384-.857.857-.857Z" />
                </svg>
                <span class="ml-2">Dashboard</span>
            </a>

            <a href="./tasks " class="text-lg  <?php echo matchesUrlEndPath("/tasks") ? 'text-slate-800' : 'text-gray-600'; ?>  group flex hover:text-amber-300">
                <svg class="w-6 h-6 <?php echo matchesUrlEndPath("/tasks") ? 'text-amber-500' : 'text-gray-600'; ?> dark:text-white group-hover:text-amber-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778" />
                </svg>


                <span class="ml-2">Tasks</span>
            </a>

            <a href="./profile " class="text-lg  <?php echo matchesUrlEndPath("/profile") ? 'text-slate-800' : 'text-gray-600'; ?>  group flex hover:text-amber-300">
                <svg class="w-6 h-6 <?php echo matchesUrlEndPath("/profile") ? 'text-amber-500' : 'text-gray-600'; ?> dark:text-white group-hover:text-amber-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>


                <span class="ml-2">Profile</span>
            </a>

            <a href="./logout " class="text-lg  text-gray-600  group flex hover:text-amber-300">
                <svg class="w-6 h-6 rotate-180 text-gray-600 dark:text-white group-hover:text-amber-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                </svg>
                <span class="ml-2">Logout</span>
            </a>
        </div>
    </aside>
    <main class="col-span-5 bg-slate-100 h-full">
        <header class="rounded-3xl px-10 flex items-center justify-between py-4 shadow-sm bg-white w-[98%] mx-auto my-3">
            <h2 class="text-xl ">Welcome John Doe</h2>
            <div class=" text-lg text-white font-semibold w-8 h-8 bg-amber-400 text-center flex items-center justify-center rounded-full">
                wj
            </div>
        </header>

        <section class="w-[97%] mx-auto py-4 px-2">
            <?php echo getContent();  ?>
        </section>
    </main>
</body>