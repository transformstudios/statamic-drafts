if (document.readyState !== 'loading') {
    addDrafts();
} else {
    document.addEventListener('DOMContentLoaded', function () {
        addDrafts();
    });
}

function addDrafts() {
    let html = `
        <button aria-expanded="false" aria-haspopup="true" class="btn dropdown-toggle" data-toggle="dropdown" type="button">
            <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a href="/!/Drafts/view/${url}" target="_blank">Draft URL</a>
            </li>
        </ul>`;

    let buttonGroup = $('#publish-controls div:first-child');
    buttonGroup
        .addClass('btn-group')
        .append(html);
}