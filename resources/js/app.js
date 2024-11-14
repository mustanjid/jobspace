import "./bootstrap";
import "./flowbite";
import "./flowbite.min";
import "../css/app.css";
import "../css/flowbite.min.css";
import.meta.glob(["../images/**"]);

document.addEventListener("livewire:navigating", () => {
    // Mutate the HTML before the page is navigated away...
    initFlowbite();
});

document.addEventListener("livewire:navigated", () => {
    // Reinitialize Flowbite components
    initFlowbite();
});
