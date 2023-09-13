<div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="POST" action="?mod=product&action=filter_check&cat_id=<?php if(!empty($_GET["cat_id"])) echo $_GET["cat_id"]; ?>&page=<?php if(!empty($_GET["page"])) echo $_GET["page"]; ?>">
                        <!-- <input type="hidden" name="mod" value = "product">
                        <input type="hidden" name="action" value = "filter_check">
                        <input type="hidden" name="cat_id" value = "<?php if(!empty($_GET["cat_id"])) echo $_GET["cat_id"]; ?>">
                        <input type="hidden" name="page" value = "<?php if(!empty($_GET["page"])) echo $_GET["page"]; ?>"> -->
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price" class="r-price" value="1" ></td>
                                    <td>Dưới 500.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="2"></td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="3"></td>
                                    <td>1.000.000đ - 5.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="4"></td>
                                    <td>5.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="5"></td>
                                    <td>Trên 10.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Hãng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-brand" value="1"></td>
                                    <td>Iphone</td>
                                </tr>                              
                                <tr>
                                    <td><input type="radio" name="r-brand" value="2"></td>
                                    <td>Samsung</td>
                                </tr> 
                                <tr>
                                    <td><input type="radio" name="r-brand" value="3"></td>
                                    <td>Dell</td>
                                </tr>                              
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Loại</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-cat" value="1"></td>
                                    <td>Điện thoại</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-cat" value="2"></td>
                                    <td>Laptop</td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit">Lọc</button>
                    </form>
                </div>
            </div>