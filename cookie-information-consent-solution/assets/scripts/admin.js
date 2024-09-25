jQuery(document).on('ready', function(jQuery){
    postboxes.init();
    postboxes.add_postbox_toggles();
    postboxes._mark_area()
});

function copyToClipboard(id){
    event.preventDefault();
    var input = document.getElementById(id);
    input.select();
    document.execCommand("copy");
}

document.addEventListener('DOMContentLoaded', function() {
    const videoAutoblockingCheckbox = document.getElementById('videoAutoblocking');
    const videoSettingsRows = document.querySelectorAll('tr.videoSetting');

    function toggleVideoSettings() {
        videoSettingsRows.forEach(row => {
            row.classList.toggle('hidden', !videoAutoblockingCheckbox.checked);
        });
    }

    videoAutoblockingCheckbox.addEventListener('change', toggleVideoSettings);
    toggleVideoSettings();

    const popupCheckbox = document.getElementById('popup');
    const popupSettingsCheckboxes = document.querySelectorAll('.popupSetting');

    function togglePopupSettings() {
        popupSettingsCheckboxes.forEach(checkbox => {
            checkbox.disabled = !popupCheckbox.checked;
        });
    }

    popupCheckbox.addEventListener('change', togglePopupSettings);
    togglePopupSettings();
});