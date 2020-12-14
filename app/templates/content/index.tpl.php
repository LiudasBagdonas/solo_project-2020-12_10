<main>
    <div class="pizzas_box">
        <?php if (!empty($data)): ?>
            <?php foreach ($data['pizzas'] as $index => $item): ?>
                <div class="pizza_box">
                    <img class="pizza_img" src="<?php print $item['photo']; ?>" alt="pizza_img">
                    <h4 class="pizza_name"><?php print $item['name']; ?></h4>
                    <p class="pizza_price"><?php print $item['price']; ?> Eur.</p>
                    <?php if (isset($_SESSION['role'])): ?>
                        <?php if ($_SESSION['role'] == 'user'): ?>
                            <div class="order_button">
                                <?php print $data['pizzas'][$index]['order_button']; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <div class="edit_button">
                                <?php print $data['pizzas'][$index]['edit_button']; ?>
                            </div>
                            <div class="delete_button">
                                <?php print $data['pizzas'][$index]['delete']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php if (isset($data['login'])): ?>
        <div>
            <?php print $data['login']; ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['role'])): ?>
    <?php if ($_SESSION['role'] == 'admin'): ?>
        <div class="login_button">
            <?php print $data['redirect']; ?>
        </div>
    <?php endif; ?>
    <?php endif; ?>
</main>