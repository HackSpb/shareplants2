            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Обратная связь</h2>
                            </div>

                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <input type="text" class="form-control" id="first_name" value="<?= $user_firstname ?>" placeholder="Имя" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="email" class="form-control" id="email" placeholder="E-mail" value="<?= $user_email ?>">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="message_title" placeholder="Тема" value="<?= $message_title ?>">
                                    </div>
                                    <div class="col-12 mb-3">
                                       <select class="w-100" name="city_id">
                                            <option value="1" selected>Санкт-Петербург</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10" placeholder="Оставьте сообщение"></textarea>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <input type="submit" class="btn" id="f" value="Отправить">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <!-- ##### Main Content Wrapper End ##### -->