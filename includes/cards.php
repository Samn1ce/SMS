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
        "modal" => true,
        "modalDetail" => "View Details"
    ],
    [
        "category" => "term",
        "title" => "School Fees",
        "detail" => "Paid",
        "icon" => "fees",
        "color" => "bg-sky-600",
        "modal" => true,
        "modalDetail" => "View"
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
    ]
];

function renderCards($cards, $category, $conn, $id, $className) {
    foreach ($cards as $card) {

        if ($card["category"] !== $category) continue;

        $detail = $card["detail"];
        if(isset($card["modalDetail"])) {
            $modalDetail = $card["modalDetail"];
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
            <div>
                <p class="text-sm text-zinc-400 font-semibold">'.$card["title"].'</p>
                <p class="text-neutral-900 font-semibold">'.$detail; echo '. ';
        
                if (!empty($card["modal"])) {
                    echo ' <span class="text-blue-400 border-dotted border-b border-b-blue-400 cursor-pointer" x-on:click="open = true">'.htmlspecialchars($modalDetail).'</span>';
                }

                echo '</p>
            </div>
        </div>';
    }
}
