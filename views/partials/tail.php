        <script>
            const closeAlert = () => {
                const alert = document.querySelector('.alert');
                alert.classList.add('hidden')
            }

            setTimeout(() => closeAlert(), 5000);
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.join-item').forEach(function(item) {
                    item.addEventListener('click', function() {
                        const url = new URL(window.location.href);
                        url.searchParams.set('page', this.getAttribute('data-page'));
                        window.location.href = url.toString();
                    });
                });
            });
        </script>
    </body>
</html>
