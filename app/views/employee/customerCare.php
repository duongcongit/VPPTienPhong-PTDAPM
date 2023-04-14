<?php
    if (!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if (!isset($_SESSION['empID'])) {
        header("Location:" .SITEURL."employee/login");
    }
    include _DIR_ROOT.'/app/views/employee/partials/header.php';  
?> 
<div class="col main-right container-fluid">
<div class="col-md-12 mt-4 mb-3 nav-page">
    <h5 class="text-muted"><a href="<?php echo SITEURL; ?>employee/index">Trang nhân viên</a> / </span><a href="<?php echo SITEURL ?>employee/customerCare">Chăm sóc khách hàng</a></h5>
</div>
<div class="container-fluid mt-4">
		<div class="row chatbox">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header text-center">Danh sách khách hàng</div>
				</div>
				<div class="card mb-3">
					<div class="message-list">
						<div class="card">
							<div class="message ">
								<img src="<?php echo SITEURL; ?>/app/views/assets/img/kh1.jpg" alt="Avatar">
								<div class="message-content ">
									<p>Giá sản phẩm hiện tại là 1.000.000 VNĐ ạ!</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="message">
								<img src="<?php echo SITEURL; ?>/app/views/assets/img/kh2.jpg" alt="Avatar">
								<div class="message-content">
									<p>Đây là tin nhắn của khách hàng 2</p>
								</div>
							</div>
						</div>
						<!-- Thêm các tin nhắn khác của khách hàng tại đây -->
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-header text-center">Khách hàng 1 </div>
					<div class="card-body chat">
						<div class="chat-message received">
							<img src="<?php echo SITEURL; ?>/app/views/assets/img/kh1.jpg" alt="Avatar" class="chat-avatar">
							<div class="message-bubble">
								<p>Chào bạn!</p>
							</div>
						</div>
						<div class="chat-message sent">
							<div class="message-bubble">
								<p>Chào bạn, tôi có thể giúp gì cho bạn ạ?</p>
							</div>
							<img src="<?php echo SITEURL; ?>/app/views/assets/img/logotp.png" alt="Avatar" class="chat-avatar">
						</div>
						<div class="chat-message received">
							<img src="<?php echo SITEURL; ?>/app/views/assets/img/kh1.jpg" alt="Avatar" class="chat-avatar">
							<div class="message-bubble">
								<p>Tôi muốn hỏi về sản phẩm này</p>
							</div>
						</div>
						<div class="chat-message sent">
							<div class="message-bubble">
								<p>Dạ, sản phẩm này có gì bạn cần tư vấn thêm không ạ?</p>
							</div>
							<img src="<?php echo SITEURL; ?>/app/views/assets/img/logotp.png" alt="Avatar" class="chat-avatar">
						</div>
						<div class="chat-message received">
							<img src="<?php echo SITEURL; ?>/app/views/assets/img/kh1.jpg" alt="Avatar" class="chat-avatar">
							<div class="message-bubble">
								<p>Tôi cần biết giá sản phẩm</p>
							</div>
						</div>
						<div class="chat-message sent">
							<div class="message-bubble">
								<p>Giá sản phẩm hiện tại là 1.000.000 VNĐ ạ!</p>
							</div>
							<img src="<?php echo SITEURL; ?>/app/views/assets/img/logotp.png" alt="Avatar" class="chat-avatar">
						</div>
					</div>
					<div class="card-footer">
						<form>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Nhập tin nhắn...">
								<button type="submit" class="btn btn-primary">Gửi</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

</div>

</div>
<?php
   include _DIR_ROOT.'/app/views/employee/partials/footer.php';  
?>