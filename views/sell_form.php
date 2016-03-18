<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <select class="form-control" name="symbol" style="color: pink; font-family: Tahoma; font-size: 17px">
                <option value="Symbol">Symbol</option>
                <?php 
                foreach( $symbols as $symbol)
                {
                    echo '<option value="'.$symbol["symbol"].'">'.$symbol["symbol"].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group" style="font-family: Tahoma">
            <input autocomplete="off" autofocus class="form-control" name="newshares" placeholder="Shares" type="int"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit" style="font-family: Tahoma; color: purple; font-size: 20px">Sell</button>
        </div>
        <img src="https://www.google.com.mx/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwjsh8GHn8nLAhUMz2MKHWE8DNsQjRwIBw&url=https%3A%2F%2Fsites.psu.edu%2Fsiowfa15%2F2015%2F10%2F22%2Fcan-money-make-us-happy%2F&psig=AFQjCNGlJNhb_JYqtvDkpfvQr8ciu-cuyQ&ust=1458356387304972" class="img-rounded" style="width:250px; height:150px;">
    </fieldset>
</form>

