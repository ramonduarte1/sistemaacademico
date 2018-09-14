<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <dialog id="favDialog">
            <form method="dialog">
                <section>
                    <p><label for="favAnimal">Favorite animal:</label>
                        <select id="favAnimal">
                            <option></option>
                            <option>Brine shrimp</option>
                            <option>Red panda</option>
                            <option>Spider monkey</option>
                        </select></p>
                </section>
                <menu>
                    <button id="cancel" type="reset">Cancel</button>
                    <button type="submit">Confirm</button>
                </menu>
            </form>
        </dialog>
        <menu>
            <button id="updateDetails">dialog exemplo</button>
        </menu>
        <script>
            (function () {
                var updateButton = document.getElementById('updateDetails');
                var cancelButton = document.getElementById('cancel');
                var favDialog = document.getElementById('favDialog');

                // O botão Update abre uma Dialog
                updateButton.addEventListener('click', function () {
                    favDialog.showModal();
                });

                // O botão cancelButtom fecha uma Dialog
                cancelButton.addEventListener('click', function () {
                    favDialog.close();
                });
            })();
        </script>
    </body>
</html>
