<?php

$pageTitle = "Sign Up | TaskHive";
require "header.php";

function getFormValue($valName)
{
    return isset($_GET["errors"]) ? $_SESSION["regisFormValues"]["$valName"] ?? "" : "";
}

?>

<body class="font-dmsans">
    <section class="signup-container h-dvh flex items-center flex-col justify-center">
        <section class="min-w-[500px] max-w-[600px]  relative z-10 ">
            <h4 class="text-3xl text-center mb-6 mx-auto rounded-tr-3xl rounded-bl-3xl px-2 py-[2px] bg-white    text-black w-fit font-semibold">
                Task Hive
            </h4>
            <form class="bg-white py-10 px-10 rounded-2xl" method="POST" action="./signup">

                <h2 class="text-3xl font-semibold text-center mb-4">Create An Account</h2>

                <div class="mb-6">
                    <?php
                    if (isset($_GET["errors"])) {
                        $errorsArr = explode("_", $_GET["errors"]);
                        foreach ($errorsArr as $error) {
                            echo "<p class='bg-red-100 text-red-500 py-1 px-2 my-2 rounded-md'> $error </p>";
                        }
                    }
                    ?>
                </div>

                <label class="block font-semibold text-slate-700 mb-2">Your email</label>
                <input required type="email" class="bg-slate-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter email" name="email" value="<?php echo getFormValue("email") ?>" />


                <label class="block font-semibold text-slate-700 mb-2">Password</label>
                <div class="flex items-center justify-between bg-slate-50 rounded-md border-[1px] border-slate-200 mb-4">
                    <input required id="password" type="password" class="bg-transparent px-4 outline-none  block w-full py-2  rounded-md " placeholder="enter password" name="password" class="block" value="<?php echo getFormValue("password") ?>" />
                    <button class="px-2" type="button" id="showpassword">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        <svg class="w-6 h-6 hidden text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="m4 15.6 3.055-3.056A4.913 4.913 0 0 1 7 12.012a5.006 5.006 0 0 1 5-5c.178.009.356.027.532.054l1.744-1.744A8.973 8.973 0 0 0 12 5.012c-5.388 0-10 5.336-10 7A6.49 6.49 0 0 0 4 15.6Z" />
                            <path d="m14.7 10.726 4.995-5.007A.998.998 0 0 0 18.99 4a1 1 0 0 0-.71.305l-4.995 5.007a2.98 2.98 0 0 0-.588-.21l-.035-.01a2.981 2.981 0 0 0-3.584 3.583c0 .012.008.022.01.033.05.204.12.402.211.59l-4.995 4.983a1 1 0 1 0 1.414 1.414l4.995-4.983c.189.091.386.162.59.211.011 0 .021.007.033.01a2.982 2.982 0 0 0 3.584-3.584c0-.012-.008-.023-.011-.035a3.05 3.05 0 0 0-.21-.588Z" />
                            <path d="m19.821 8.605-2.857 2.857a4.952 4.952 0 0 1-5.514 5.514l-1.785 1.785c.767.166 1.55.25 2.335.251 6.453 0 10-5.258 10-7 0-1.166-1.637-2.874-2.179-3.407Z" />
                        </svg>
                    </button>
                </div>


                <label class="block font-semibold text-slate-700 mb-2">Confirm Password</label>
                <div class="flex items-center justify-between bg-slate-50 rounded-md border-[1px] border-slate-200 mb-8">
                    <input id="confirmpassword" required type="password" class="bg-transparent px-4 outline-none  block w-full py-2  rounded-md " placeholder="enter password" name="password_confirmation" class="block" value="<?php echo getFormValue("password_confirmation") ?>" />
                    <button class="px-2" type="button" id="showpassword2">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>


                        <svg class="w-6 h-6 hidden text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="m4 15.6 3.055-3.056A4.913 4.913 0 0 1 7 12.012a5.006 5.006 0 0 1 5-5c.178.009.356.027.532.054l1.744-1.744A8.973 8.973 0 0 0 12 5.012c-5.388 0-10 5.336-10 7A6.49 6.49 0 0 0 4 15.6Z" />
                            <path d="m14.7 10.726 4.995-5.007A.998.998 0 0 0 18.99 4a1 1 0 0 0-.71.305l-4.995 5.007a2.98 2.98 0 0 0-.588-.21l-.035-.01a2.981 2.981 0 0 0-3.584 3.583c0 .012.008.022.01.033.05.204.12.402.211.59l-4.995 4.983a1 1 0 1 0 1.414 1.414l4.995-4.983c.189.091.386.162.59.211.011 0 .021.007.033.01a2.982 2.982 0 0 0 3.584-3.584c0-.012-.008-.023-.011-.035a3.05 3.05 0 0 0-.21-.588Z" />
                            <path d="m19.821 8.605-2.857 2.857a4.952 4.952 0 0 1-5.514 5.514l-1.785 1.785c.767.166 1.55.25 2.335.251 6.453 0 10-5.258 10-7 0-1.166-1.637-2.874-2.179-3.407Z" />
                        </svg>

                    </button>
                </div>

                <input type="submit" name="signup" value="Sign Up" class="w-full cursor-pointer bg-black rounded-md text-white px-4 text-center py-2 hover:opacity-90 active:opacity-30" />
                <p class="mt-3 text-center">Already have an account? <a href="./login" class="underline font-semibold"> log in here </a> </p>

            </form>
        </section>

    </section>
</body>
<script>
    const showPasswordTrigger = document.getElementById("showpassword");
    const passwordInput = document.getElementById("password");

    const showPassword2Trigger = document.getElementById("showpassword2");
    const confirmPasswordInput = document.getElementById("confirmpassword");


    function togglePasswordVisibility(trigger, input) {
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
        trigger.firstElementChild.classList.toggle("hidden");
        trigger.children[1].classList.toggle("hidden");
    }

    showPasswordTrigger.addEventListener("click", () => {
        togglePasswordVisibility(showPasswordTrigger, passwordInput);
    });

    showPassword2Trigger.addEventListener("click", () => {
        togglePasswordVisibility(showPassword2Trigger, confirmPasswordInput);
    });
</script>

</html>