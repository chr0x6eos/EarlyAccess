<div class="card header">
<div class="card-header">
    Hashing-Tools
</div>
<div class="card-body center">
    <script>
        function change() 
        {
            var btn = document.getElementById("btn");
            var hash = document.getElementById("hash");
            var verify = document.getElementById("verify");

            if (hash.style.display === "none") {
                hash.style.display = "block";
                verify.style.display = "none";
                btn.innerHTML = "Hash";
            }
            else
            {
                verify.style.display = "block";
                hash.style.display = "none";
                btn.innerHTML = "Verify";
            }
        }
    </script>
    <ul style="list-style-type: none">
            <li>
                <label for="btn">Action:</label>
                <button id="btn" name="btn" class="btn btn-outline-dark" onclick=change()>Hash</button>
                <br>
            </li>
    </ul>
    <form id="hash" action="/actions/hash.php" method="POST">
        <input type="hidden" name="action" value="hash"/>
        <input type="hidden" name="redirect" value="true" />
        <ul style="list-style-type: none">
            <li>
                <label for="password">Password:</label>
                <input type="text" placeholder="P@ssw0rd" name="password">
                <br>
            </li>
            <div class="btn-group">
                <input type="submit" class="btn btn-outline-success" value="Hash"/>
                <select type="button" name="hash_function" class="btn btn-success dropdown-toggle dropdown-toggle-split">
                    <option selected value="md5">MD5</option>
                    <option value="sha1">SHA-1</option>
                    <option disabled>More coming soon!</option>
                </select>
            </div>
        </ul>
    </form>
    <form id="verify" style="display:none" action="/actions/hash.php" method="POST">
        <input type="hidden" name="action" value="verify"/>
        <input type="hidden" name="redirect" value="true" />
        <ul style="list-style-type: none">
            <li>
                <label for="password">Password:</label>
                <input type="text" placeholder="P@ssw0rd" name="password">
                <br>
            </li>
            <li>
                <label for="hash">Hash:</label>
                <input type="text" placeholder="161ebd7d45089b3446ee4e0d86dbcf92" name="hash">
                <br>
            </li>
            <div class="btn-group">
                <input type="submit" class="btn btn-outline-success" value="Verify"/>
                <select type="button" name="hash_function" class="btn btn-success dropdown-toggle dropdown-toggle-split">
                    <option selected value="md5">MD5</option>
                    <option value="sha1">SHA-1</option>
                    <option disabled>More coming soon!</option>
                </select>
            </div>
        </ul>
    </form>
    <?php
        if(isset($_SESSION['hash'])) {
            echo '<h3>Hashed password:</h3>' . $_SESSION['hash'];
            unset($_SESSION['hash']);
        }
        elseif(isset($_SESSION['verify']))
        {
            if ($_SESSION['verify'])
                echo '<h3 class="btn-outline-success">Password and hash match!</h3>';
            else
                echo '<h3 class="btn-outline-danger">Password and hash does not match!</h3>';
            unset($_SESSION['verify']);
        }
    ?>
</div>