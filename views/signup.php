<?php
$pageTitle = "Sign Up | TaskHive";
require "header.php";
?>

<body class="font-dmsans">
    <section class="signup-container  h-dvh flex items-center flex-col justify-center">
        <section class="min-w-[500px] relative z-10 ">
            <h4 class="text-3xl text-center mb-6 mx-auto rounded-tr-3xl rounded-bl-3xl px-2 py-[2px] bg-white    text-black w-fit font-semibold">
                Task Hive
            </h4>
            <form class="bg-white py-10 px-6 rounded-2xl">
                <h2 class="text-3xl font-semibold text-center mb-8">Create An Account</h2>
                <label class="block font-semibold text-slate-700 mb-2">Your email</label>
                <input class="bg-slate-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter email" name="email" />
                <label class="block font-semibold text-slate-700 mb-2">Password</label>
                <input class="bg-slate-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter password" name="password" class="block" />

                <label class="block font-semibold text-slate-700 mb-2">Confirm Password</label>
                <input class="bg-slate-50 px-4 py-2 block w-full mb-10 rounded-md border-[1px] border-slate-200" placeholder="enter password" name="password" class="block" />

                <button class="w-full bg-black rounded-md text-white px-4 text-center py-2 hover:opacity-90 active:opacity-30">Sign Up </button>
            </form>
        </section>

    </section>
</body>

</html>