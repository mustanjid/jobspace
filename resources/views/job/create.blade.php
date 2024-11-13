<x-layout>
    <x-page-heading>New Job</x-page-heading>

    <x-forms.form method="POST" id="job-form" action="/jobs">
        <x-forms.input label="Title" name="title" placeholder="CEO" />
        <x-forms.input label="Salary" name="salary" placeholder="90,000 Tk || 40,000-50,000 TK" />
        <x-forms.input label="Location" name="location" placeholder="Dhaka, Bangladesh" />

        <x-forms.select label="Schedule" name="schedule">
            <option>Select</option>
            <option>Part Time</option>
            <option>Full Time</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" placeholder="https://acme.com/jobs/ceo-wanted" />
        <x-forms.checkbox label="Feature (Costs Extra)" name="featured" />

        <x-forms.input label="Tags (Add a tag and press enter or select from below)" id="tag-input"
            placeholder="Web Development" name="tag-input" />
        <div id="suggested-tags"></div>
        <div id="selected-tags">Selected Tags:</div>

        <x-forms.button>Publish</x-forms.button>
    </x-forms.form>
</x-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let selectedTags = [];

        // Fetch suggested tags on page load
        $.ajax({
            url: '/tags',
            method: 'GET',
            success: function(tags) {
                let tagList = '';
                tags.forEach(tag => {
                    tagList +=
                        `<button type="button" class="suggested-tag bg-gray-200 text-gray-700 py-1 px-2 rounded m-1 hover:bg-gray-300 transition" data-name="${tag.name}">${tag.name}</button>`;
                });
                $('#suggested-tags').html(tagList);
            }
        });

        // Add tag when user clicks on a suggested tag
        $(document).on('click', '.suggested-tag', function() {
            let tagName = $(this).data('name');
            addTag(tagName);
        });

        // Add custom tag when Enter is pressed in the tag input
        $('#tag-input').on('keypress', function(e) {
            if (e.which === 13 || e.which === 10) { // Both default and numeric keypad Enter
                e.preventDefault();
                let tagName = $(this).val().trim();
                if (tagName) {
                    addTag(tagName);
                    $(this).val(''); // Clear the input field
                }
            }
        });

        // Add a tag (avoid duplicates, add hidden input, and display visually)
        function addTag(tagName) {
            if (!selectedTags.includes(tagName)) {
                selectedTags.push(tagName);
                
                // Add to selected tags display
                $('#selected-tags').append(`
                    <span class="tag-item bg-blue-100 text-blue-700 py-1 px-2 rounded inline-flex items-center m-1">
                        ${tagName}
                        <button type="button" class="remove-tag ml-2 bg-red-500 text-white rounded-full h-5 w-5 flex items-center justify-center focus:outline-none">&times;</button>
                    </span>
                `);
                
                // Add hidden input for form submission
                $('#job-form').append(`<input type="hidden" name="tags[]" value="${tagName}" class="tag-hidden-input">`);
            }
        }

        // Remove tag when the "remove" button is clicked
        $(document).on('click', '.remove-tag', function() {
            let tagName = $(this).parent().text().trim().replace("×", "");
            selectedTags = selectedTags.filter(tag => tag !== tagName);

            // Remove visual tag display
            $(this).parent().remove();

            // Remove the corresponding hidden input
            $(`input[name="tags[]"][value="${tagName}"]`).remove();
        });
    });
</script>
