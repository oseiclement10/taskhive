<?php

use App\Controllers\TaskController;

$data = TaskController::getDashboardData();
$upcomingTasks = $data["upcoming_tasks"];

function getColorCombination($index)
{
    $colorSchemes = [
        "bg-amber-50 border-amber-400",
        "bg-emerald-50 border-green-400",
        "bg-slate-100 border-slate-600",
        "bg-gray-100 border-gray-600",
    ];
    return $colorSchemes[$index % count($colorSchemes)];
}

function getOrdinalSuffix($day)
{
    if (!in_array(($day % 100), array(11, 12, 13))) {
        switch ($day % 10) {
            case 1:
                return $day . 'st';
            case 2:
                return $day . 'nd';
            case 3:
                return $day . 'rd';
        }
    }
    return $day . 'th';
}
$day = date('j');
$dayWithSuffix = getOrdinalSuffix($day);
$month = date('F');

?>
<section>
    <h2 class="font-semibold text-slate-800 text-2xl flex items-center mb-6 ">

        <span>Dashboard</span>

        <svg class=" mt-1 ml-4 mr-[2px] w-4 h-4 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m11.5 11.5 2.071 1.994M4 10h5m11 0h-1.5M12 7V4M7 7V4m10 3V4m-7 13H8v-2l5.227-5.292a1.46 1.46 0 0 1 2.065 2.065L10 17Zm-5 3h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
        </svg>
        <span class=" mt-1 text-sm text-gray-600 font-normal ">
            <?php echo "$dayWithSuffix $month ";; ?>
        </span>

    </h2>


    <section class="grid grid-cols-3 gap-8  mb-8 lg:w-[94%]">
        <div class="border border-slate-200 rounded-2xl px-5 py-3">
            <h1 class="text-2xl font-semibold text-gray-700 mb-1"><?php echo $data["today"]; ?></h1>
            <div class="flex justify-between items-center">
                <h2 class="text-slate-800 font-semibold mb-2 ">Due Today</h2>
                <span class="px-2 text-sm font-semibold py-[1px]  rounded-md bg-emerald-100 flex"> <?php echo $data["completed_today"] . "/" . $data["today"];   ?></span>
            </div>

        </div>
        <div class="border border-amber-300 rounded-2xl px-5 py-3">
            <h1 class="text-2xl font-semibold text-gray-700 mb-1"><?php echo $data["this_week"]; ?></h1>
            <div class="flex justify-between items-center">
                <h2 class="text-slate-800 font-semibold mb-2">Due This Week</h2>
                <span class="px-2 text-sm font-semibold py-[1px]  rounded-md bg-amber-100 flex"> <?php echo $data["completed_this_week"] . "/" . $data["this_week"];  ?> </span>
            </div>

        </div>
        <div class="border border-amber-200 rounded-2xl px-5 py-3 bg-amber-100">
            <h1 class="text-2xl font-semibold text-gray-700 mb-1"><?php echo $data["this_month"]; ?></h1>
            <div class="flex justify-between items-center">
                <h2 class="text-slate-800 font-semibold mb-2">Due This Month</h2>
                <span class="bg-white/85 shadow-sm text-slate-800 px-2 text-sm font-semibold py-[1px] rounded-md flex"><?php echo $data["completed_this_month"] . "/" . $data["this_month"];  ?></span>
            </div>

        </div>
    </section>

    <h2 class="text-xl font-semibold text-slate-800 mb-4">
        Upcoming Tasks
    </h2>

    <div class="section grid gap-4 lg:w-[94%] ">
        <?php foreach ($upcomingTasks as $index => $task) { ?>
            <div class=" py-2 px-3 border-l-4  <?php echo getColorCombination($index) ?> ">
                <h2 class="mb-1 text-lg font-semibold text-slate-800"><?php echo $task["title"]; ?></h2>
                <p class="text-slate-800 text-sm flex items-center">
                    <svg class="w-4 h-4 mr-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    due at <?php echo date("F d, h:i", strtotime($task["due_datetime"]));  ?>
                </p>
            </div>

        <?php } ?>



    </div>


</section>