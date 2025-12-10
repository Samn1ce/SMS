<?php
function renderIcon($name, $class = '') {
    switch($name) {
        case 'email':
            echo '
            <svg xmlns="http://www.w3.org/2000/svg" 
                width="16" 
                height="16" 
                fill="currentColor" 
                class="bi bi-envelope-at ' . htmlspecialchars($class) . '" 
                viewBox="0 0 16 16"
            >
                <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
                <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
            </svg>';
        break;
        case 'password':
            echo '
                <svg xmlns="http://www.w3.org/2000/svg" 
                    width="16" 
                    height="16" 
                    fill="currentColor" 
                    class="bi bi-lock ' . htmlspecialchars($class) . '" 
                    viewBox="0 0 16 16"
                >
                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                </svg>
            ';
        break;
        case 'exclamation':
            echo '
                <svg xmlns="http://www.w3.org/2000/svg" 
                    width="16" 
                    height="16" 
                    fill="currentColor" 
                    class="bi bi-exclamation-circle-fill '. htmlspecialchars($class) .'" 
                    viewBox="0 0 16 16"
                >
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4m.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                </svg>
            ';
        break;
        case 'name':
            echo '
                <svg xmlns="http://www.w3.org/2000/svg" 
                    width="16" 
                    height="16" 
                    fill="currentColor" 
                    class="bi bi-person ' . htmlspecialchars($class) . '" 
                    viewBox="0 0 16 16"
                >
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg>
            ';
        break;
        case 'person':
            echo '
                <svg xmlns="http://www.w3.org/2000/svg" 
                    width="16" 
                    height="16" 
                    fill="currentColor" 
                    class="bi bi-person-badge ' . htmlspecialchars($class) . '" 
                    viewBox="0 0 16 16"
                >
                    <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z"/>
                </svg>
            ';
        break;
        case 'grade':
            echo '
                <svg xmlns="http://www.w3.org/2000/svg" 
                    width="16" 
                    height="16" 
                    fill="currentColor" 
                    class="bi bi-mortarboard '. htmlspecialchars($class) . '" 
                    viewBox="0 0 16 16"
                >
                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z"/>
                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z"/>
                </svg>
            ';
            break;
            case 'sessionStatus':
                echo '
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="16" height="16" 
                        fill="currentColor" 
                        class="bi bi-bookmark-fill '. htmlspecialchars($class) . '" 
                        viewBox="0 0 16 16"
                    >
                        <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2"/>
                    </svg>
                ';
            break;
            case 'term':
                echo '
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="16" 
                        height="16" 
                        fill="currentColor" 
                        class="bi bi-cloud-fog2-fill '. htmlspecialchars($class) . '" 
                        viewBox="0 0 16 16"
                    >
                        <path d="M8.5 3a5 5 0 0 1 4.905 4.027A3 3 0 0 1 13 13h-1.5a.5.5 0 0 0 0-1H1.05a3.5 3.5 0 0 1-.713-1H9.5a.5.5 0 0 0 0-1H.035a3.5 3.5 0 0 1 0-1H7.5a.5.5 0 0 0 0-1H.337a3.5 3.5 0 0 1 3.57-1.977A5 5 0 0 1 8.5 3"/>
                    </svg>
                ';
            break;
            case 'session':
                echo '
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="16" 
                        height="16" 
                        fill="currentColor" 
                        class="bi bi-calendar2 '. htmlspecialchars($class) . '" 
                        viewBox="0 0 16 16"
                    >
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
                        <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                ';
            break;
            case 'subjects':
                echo '
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="16" 
                        height="16" 
                        fill="currentColor" 
                        class="bi bi-book-half '. htmlspecialchars($class) .'" 
                        viewBox="0 0 16 16"
                    >
                        <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                    </svg>
                ';
            break;
            case 'fees':
                echo '
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="16" 
                        height="16" 
                        fill="currentColor" 
                        class="bi bi-wallet2 '. htmlspecialchars($class) .'" 
                        viewBox="0 0 16 16"
                    >
                        <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
                    </svg>
                ';
            break;
            case 'termsCompleted':
                echo '
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="16" 
                        height="16" 
                        fill="currentColor" 
                        class="bi bi-list-nested '. htmlspecialchars($class) .'" 
                        viewBox="0 0 16 16"
                    >
                        <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h10a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m-2-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m-2-4A.5.5 0 0 1 1 3h10a.5.5 0 0 1 0 1H1a.5.5 0 0 1-.5-.5"/>
                    </svg>
                ';
            break;
            case 'personProfile':
                echo '
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="16" 
                        height="16" 
                        fill="currentColor" 
                        class="bi bi-person-fill '. htmlspecialchars($class) .'" 
                        viewBox="0 0 16 16"
                    >
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                ';
            break;
            case 'gender':
                echo '
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="16" 
                        height="16" 
                        fill="currentColor" 
                        class="bi bi-gender-neuter '. htmlspecialchars($class) .'" 
                        viewBox="0 0 16 16"
                    >
                        <path fill-rule="evenodd" d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8M3 5a5 5 0 1 1 5.5 4.975V15.5a.5.5 0 0 1-1 0V9.975A5 5 0 0 1 3 5"/>
                    </svg>
                ';
            break;
            case 'date':
                echo '
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="16" 
                        height="16" 
                        fill="currentColor" 
                        class="bi bi-calendar-week '. htmlspecialchars($class) .'" 
                        viewBox="0 0 16 16"
                    >
                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                    </svg>
                ';
            break;
            case 'hammer':
                echo '
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="16" 
                        height="16" 
                        fill="currentColor" 
                        class="bi bi-hammer '. htmlspecialchars($class) .'" viewBox="0 0 16 16">
                        <path d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5 5 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334"/>
                    </svg>
                ';
            break;
            case 'book':
                echo '
                    <svg viewBox="0 0 24 24" 
                        fill="none" 
                        xmlns="http://www.w3.org/2000/svg"
                        class="'. htmlspecialchars($class) .'"
                    >
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="24" height="24" fill="white"></rect> <path d="M12 6.90909C10.8999 5.50893 9.20406 4.10877 5.00119 4.00602C4.72513 3.99928 4.5 4.22351 4.5 4.49965C4.5 6.54813 4.5 14.3034 4.5 16.597C4.5 16.8731 4.72515 17.09 5.00114 17.099C9.20405 17.2364 10.8999 19.0998 12 20.5M12 6.90909C13.1001 5.50893 14.7959 4.10877 18.9988 4.00602C19.2749 3.99928 19.5 4.21847 19.5 4.49461C19.5 6.78447 19.5 14.3064 19.5 16.5963C19.5 16.8724 19.2749 17.09 18.9989 17.099C14.796 17.2364 13.1001 19.0998 12 20.5M12 6.90909L12 20.5" stroke="#000000" stroke-linejoin="round"></path> <path d="M19.2353 6H21.5C21.7761 6 22 6.22386 22 6.5V19.539C22 19.9436 21.5233 20.2124 21.1535 20.0481C20.3584 19.6948 19.0315 19.2632 17.2941 19.2632C14.3529 19.2632 12 21 12 21C12 21 9.64706 19.2632 6.70588 19.2632C4.96845 19.2632 3.64156 19.6948 2.84647 20.0481C2.47668 20.2124 2 19.9436 2 19.539V6.5C2 6.22386 2.22386 6 2.5 6H4.76471" stroke="#000000" stroke-linejoin="round"></path> </g>
                    </svg>
                ';
            break;
        default:
            echo "<!-- Unknown icon: " . htmlspecialchars($name) . " -->";

    };
};