<?php
$cards = [
    [
        "category" => "term",
        "title" => "Current Term",
        "detail" => "First Term",
        "icon" => "term",
        "color" => "bg-indigo-600"
    ],
    [
        "category" => "term",
        "title" => "Offered Subjects",
        "detail" => "You are Offering {subject_count} subjects",
        "icon" => "subjects",
        "color" => "bg-fuchsia-500",
        "modal" => [
            "trigger_text" => "View Offered Subjects",
            "modalDetail" => function($conn, $id) {
                $subjects = getSelectedSubjects($conn, $id);
                ob_start(); // Start capturing output
                ?>
                <div class="flex flex-col w-full gap-4">
                    <p class="font-bold text-center text-3xl text-neutral-800">Your Subjects are:</p>
                    <ul class="list-disc pl-6 mt-2">
                        <?php foreach ($subjects as $subject): ?>
                            <li><?= htmlspecialchars($subject) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="text-center text-sm text-neutral-800">A subject is missing? <span><a href="selectSubjects.php" class="font-semibold text-blue-400 border-b border-dotted border-b-blue-400">Check Here</a></span>, to see which one you omitted.</p>
                </div>
                <?php
                return ob_get_clean(); // Return captured output as string
            }
        ]
    ],
    [
        "category" => "term",
        "title" => "School Fees",
        "detail" => "Paid",
        "icon" => "fees",
        "color" => "bg-sky-600",
        "modal" => [
            "trigger_text" => "View Details",
            "modalDetail" => "Lorem"
        ]
    ],
    [
        "category" => "session",
        "title" => "Current Session",
        "detail" => "2025/2026 Session",
        "icon" => "session",
        "color" => "bg-teal-600"
    ],
    [
        "category" => "session",
        "title" => "Current Class",
        "detail" => "{className}",
        "icon" => "grade",
        "color" => "bg-sky-400"
    ],
    [
        "category" => "session",
        "title" => "Terms Completed",
        "detail" => "First, Second Term",
        "icon" => "termsCompleted",
        "color" => "bg-emerald-600"
    ],
    [
        "category" => "profile",
        "title" => "Noted Misconduct",
        "detail" => "No",
        "icon" => "hammer",
        "color" => "bg-amber-600"
    ],
    [
        "category" => "profile",
        "title" => "Graduated",
        "detail" => "No",
        "icon" => "grade",
        "color" => "bg-blue-600"
    ],
    [
        "category" => "profile",
        "title" => "Total terms completed",
        "detail" => "15",
        "icon" => "date",
        "color" => "bg-cyan-400"
    ],
];

function renderCards($cards, $category, $conn, $id, $className) {
    foreach ($cards as $card) {

        if ($card["category"] !== $category) continue;

        $detail = $card["detail"];
        if(isset($card["modal"])) {
            $modalDetail = $card["modal"]["trigger_text"];
        }

        // Dynamic replacements
        if (strpos($detail, '{className}') !== false) {
            $detail = str_replace('{className}', htmlspecialchars($className), $detail);
        }

        if (strpos($detail, '{subject_count}') !== false) {
            $count = count(getSelectedSubjects($conn, $id));
            $detail = str_replace('{subject_count}', $count, $detail);
        }

        echo '
        <div class="w-full h-24 bg-white rounded-md p-3 flex items-center gap-4 hover:shadow-xl duration-300 transition-all mb-4 border border-zinc-200/65">
            <div class="h-full w-20 rounded-md flex justify-center items-center '.$card["color"].'">
        ';
                renderIcon($card["icon"], "w-8 h-8 text-white");
        echo '
            </div>
                <div x-data="{ open: false }">
                    <p class="text-sm text-zinc-400 font-semibold">'.$card["title"].'</p>
                    <p class="text-neutral-900 font-semibold">'.$detail; echo '. ';
            
                    if (!empty($card["modal"])) {
                        echo ' <span class="text-blue-400 border-dotted border-b border-b-blue-400 cursor-pointer" x-on:click="open = true">'.htmlspecialchars($modalDetail).'</span>';
                    }
                echo '</p>
                    <div x-show="open">
                        <div x-transition.opacity.duration.300ms class="bg-zinc-100/20 fixed h-screen top-0 left-0 w-full flex justify-center items-center backdrop-blur-sm p-5">
                            <div x-transition.opacity.scale.duration.350ms class="bg-white/40 w-11/12 lg:w-2/5 flex justify-center items-center p-5 rounded-4xl backdrop-blur-md border-zinc-100 border shadow-lg">
                                    <div class="w-full bg-neutral-50 border border-neutral-100 rounded-3xl p-2 md:p-5">';
                                        if (is_callable($card["modal"]["modalDetail"])) {
                                            echo $card["modal"]["modalDetail"]($conn, $id);
                                        } else {
                                            echo $card["modal"]["modalDetail"];
                                        }
                                        echo '<button x-on:click="open = false" class="w-full mt-2 p-2 cursor-pointer rounded-xl bg-red-500 hover:bg-red-600/90 transition-all duration-300 text-neutral-100 font-semibold">Close</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
}
