<section>
    <div class="mb-4 ">
        <?php
        if (isset($_GET["errors"])) {
            $errorsArr = explode("_", $_GET["errors"]);
            foreach ($errorsArr as $error) {
                echo "<p  class='notif bg-red-100 text-red-500 py-1 px-2 my-2 rounded-md'> $error </p>";
            }
        } else if (isset($_GET["success"])) {
            echo "<p  class='notif bg-emerald-100 py-2 px-4 my-2 rounded-md text-green-600 lg:w-1/2'>" . $_GET["success"] . "</p>";
        }
        ?>
    </div>

    <h3 class="text-lg font-semibold text-slate-800 mb-3 pb-1 border-b border-slate-200 lg:w-4/6"> Manage your profile here</h3>
    <h4 class="text-gray-600">username</h4>
    <p class="mb-2 font-semibold text-slate-800"><?php echo $_SESSION["username"] ?></p>

    <h4 class="text-gray-600" id="greet">email</h4>
    <p class=" font-semibold text-slate-800 mb-4"><?php echo $_SESSION["email"] ?></p>

    <div class="py-3 flex items-center  space-x-3 ">
        <button id="openEditForm" class="border flex items-center space-x-2 rounded-lg border-slate-200 py-1 px-4 text-slate-700 hover:text-amber-500 hover:border-amber-500 active:opacity-10">
            <svg class="w-6 h-6  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 7.796 1.263l-2.533 2.534A4 4 0 0 1 5 8Zm4.06 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h2.172a2.999 2.999 0 0 1-.114-1.588l.674-3.372a3 3 0 0 1 .82-1.533L9.06 13Zm9.032-5a2.907 2.907 0 0 0-2.056.852L9.967 14.92a1 1 0 0 0-.273.51l-.675 3.373a1 1 0 0 0 1.177 1.177l3.372-.675a1 1 0 0 0 .511-.273l6.07-6.07a2.91 2.91 0 0 0-.944-4.742A2.907 2.907 0 0 0 18.092 8Z" clip-rule="evenodd" />
            </svg>

            edit info
        </button>
        <button id="openChangePassword" class="border flex items-center space-x-2 rounded-lg border-amber-300 py-1 px-4 hover:text-amber-500 active:opacity-10">
            <svg class="w-6 h-6  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd" />
            </svg>

            change password
        </button>
    </div>

    <section id="modalOverlay" class=" hidden w-screen h-screen  fixed top-0 left-0  items-center justify-center">
        <div class="absolute w-full h-full bg-black/70 z-1"></div>

        <div class="absolute top-0 right-0 flex justify-between py-2">
            <button class="relative text-3xl cursor-pointer top-10 right-10 text-white hover:opacity-70 active:opacity-30" id="closeOverlay">&times;</button>
        </div>

        <div class=" bg-white  rounded-2xl p-8 w-[450px] relative transition-all ease-in-out duration-150">
            <!-- BASIC INFO CHANGE -->
            <form name="userinfo" method="POST" action="/taskhive/usr/info/form" id="editUserInfo">
                <h4 id="formCaption" class="text-lg text-center font-semibold mb-4 text-slate-800 ">EDIT YOUR ACCOUNT INFO</h4>
                <label class="block font-semibold text-slate-700 mb-2">Username</label>
                <input required placeholder="new user name" name="username" value="" id="username" type="text" class="bg-slate-100 mb-4 px-4 outline-none  block w-full py-2  rounded-md " />


                <label class="block font-semibold text-slate-700 mb-2">Email</label>
                <input placeholder="change email" name="email" value="" required id="email" type="email" class="bg-slate-100 px-4 outline-none  block w-full py-2  rounded-md " />

                <div class="flex items-center justify-center space-x-3 mt-6 mb-2">
                    <input type="submit" name="updateUserInfo" value="Save Changes" class="cursor-pointer  px-4 py-1 rounded-md bg-amber-500 text-white  hover:opacity-80 active:opacity-30" />
                    <input type="button" value="Cancel" class="closeForm cursor-pointer border px-4 py-1  rounded-md  border-slate-300 hover:border-blue-400 hover:opacity-80 active:opacity-30" />
                </div>

            </form>

            <!-- PASSWORD CHANGE -->
            <form name="changepassword" method="POST" action="/taskhive/usr/info/form" id="changePassword">
                <h4 class="text-lg font-semibold mb-2 text-slate-800 text-center">CHANGE PASSWORD</h4>

                <label class="block font-semibold text-slate-700 mb-2">Current Password</label>
                <div class="flex items-center justify-between bg-slate-50 rounded-md border-[1px] border-slate-200 mb-4">
                    <input required  type="password" class="bg-transparent px-4 outline-none  block w-full py-2  rounded-md " placeholder="enter  current password" name="old_password" class="block" value="" />
                    <button class="px-2 showPassword" type="button" >
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


                <label class="block font-semibold text-slate-700 mb-2">New Password</label>
                <div class="flex items-center justify-between bg-slate-50 rounded-md border-[1px] border-slate-200 mb-4">
                    <input id="confirmpassword" required type="password" class="bg-transparent px-4 outline-none  block w-full py-2  rounded-md " placeholder="enter new password" name="new_password" class="block" value="" />
                    <button class="px-2 showPassword" type="button"  >
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
                    <input id="confirmpassword" required type="password" class="bg-transparent px-4 outline-none  block w-full py-2  rounded-md " placeholder="confirm new password" name="confirm_password" class="block" value="" />
                    <button class="px-2 showPassword" type="button" >
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

                <div class="flex items-center justify-center space-x-3 my-4">
                    <input type="submit" name="changePassword" value="Save New Password" class="cursor-pointer  px-4 py-1 rounded-md bg-amber-500 text-white  hover:opacity-80 active:opacity-30" />
                    <input type="button" value="Cancel" class="closeForm cursor-pointer border px-4 py-1  rounded-md  border-slate-300 hover:border-blue-400 hover:opacity-80 active:opacity-30" />
                </div>
            </form>

        </div>

    </section>

</section>

<script>
    const modalOverlay = document.getElementById("modalOverlay");
    const closeOverlay = document.getElementById("closeOverlay");

    const userInfoForm = document.getElementById("editUserInfo");
    const passwordForm = document.getElementById("changePassword");

    const changePasswordTrigger = document.getElementById("openChangePassword");
    const editInfoTrigger = document.getElementById("openEditForm");

    const closeFormTriggers = document.getElementsByClassName("closeForm");

    const showPasswords = document.getElementsByClassName("showPassword");

    function togglePasswordVisibility(trigger) {
        
        const parent = trigger.parentElement;
        const input = parent.children[0];

        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
        trigger.firstElementChild.classList.toggle("hidden");
        trigger.children[1].classList.toggle("hidden");
    }


    Array.from(showPasswords).forEach(elem=>{
         elem.addEventListener("click",(e)=>{
            togglePasswordVisibility(elem);
         })
    })


    Array.from(closeFormTriggers).forEach(elem => {
        elem.addEventListener("click", () => {
            modalOverlay.classList.toggle("hidden");
            modalOverlay.classList.toggle("flex");
        })
    })

    closeOverlay.addEventListener("click", (e) => {
        modalOverlay.classList.toggle("hidden");
        modalOverlay.classList.toggle("flex");
    })

    changePasswordTrigger.addEventListener("click", (e) => {
        userInfoForm.classList.add("hidden");
        passwordForm.classList.remove("hidden");

        modalOverlay.classList.toggle("hidden");
        modalOverlay.classList.toggle("flex");
    })

    editInfoTrigger.addEventListener("click", (e) => {
        passwordForm.classList.add("hidden");
        userInfoForm.classList.remove("hidden");

        modalOverlay.classList.toggle("hidden");
        modalOverlay.classList.toggle("flex");
    })
</script>