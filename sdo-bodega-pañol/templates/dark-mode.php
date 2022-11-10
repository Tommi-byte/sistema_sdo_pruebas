<label class="switch">
    <input type="checkbox" id="mode">
    <span class="slider"></span>
</label>

<script>
    const input = document.getElementById('mode');
    const body = document.getElementById('body');

    input.addEventListener('click', function() {

        if (body.classList.contains('dark-mode')) {

            body.classList.remove('dark-mode');
        } else {
            body.classList.add('dark-mode');
        }

    })
</script>