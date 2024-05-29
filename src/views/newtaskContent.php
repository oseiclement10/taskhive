<section class=" pb-8">
    <div class="flex items-center justify-between">
        <h3 class="font-semibold text-3xl text-slate-700 mb-8 ">
            Add New Task
        </h3>
        <a href="/taskhive/usr/tasks" class="text-blue-600 underline"> <-- Go Back</a>
    </div>

    <form class="w-4/6 ">
        <label class="block font-semibold text-slate-700 mb-2">Title</label>
        <input required type="text" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter task title" name="title" />

        <label class="block font-semibold text-slate-700 mb-2">Description</label>
        <input required type="text" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter task description" name="description" />

        <label class="block font-semibold text-slate-700 mb-2">Start Datetime</label>
        <input required type="datetime-local" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter task start time" name="start_datetime" />

        <label class="block font-semibold text-slate-700 mb-2">Due Datetime</label>
        <input required type="datetime-local" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter task end time" name="end_datetime" />


        <label class="block font-semibold text-slate-700 mb-2">Task Category</label>
        <select name="category" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200">
            <option value="work">Work/Business</option>
            <option value="fun">Fun</option>
            <option value="pd">Personal Development</option>
        </select>

        <div class="flex space-x-3 items-end justify-end ">
            <input type="submit" value="Save Task" name="save-task" class="bg-amber-500 text-white px-4 py-2 rounded-md hover:opacity-70 active:opacity-30" />
            <input type="button" value="Cancel" name="cancle" class="text-amber-500 bg-white border-[1px] border-amber-300 px-4 py-2 rounded-md hover:opacity-70 active:opacity-30" />
        </div>
    </form>

</section>