<template>
     <sidebarVue />
	<!-- CONTENT -->
	<section id="content">
		<headerVue />

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<span>Dashboard</span>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Trang Chính</a>
						</li>
					</ul>
				</div>
			</div>
            <section class="overview" id="overview">
                    <div class="overview_left">
                        <div class="overview_skills">
                            <div class="overview_skills-title">
                                <h3>Frontend developer</h3>
                            </div>
                            <div class="skills_data">
                                <div class="skills_titles">
                                    <h3 class="skills_name">HTML</h3>
                                    <span class="skills_number">90%</span>
                                </div>
                                <div class="skills_bar">
                                    <span class="skills_percentage skills_html"></span>
                                </div>
                            </div>
                            <div class="skills_data">
                                <div class="skills_titles">
                                    <h3 class="skills_name">CSS</h3>
                                    <span class="skills_number">80%</span>
                                </div>
                                <div class="skills_bar">
                                    <span class="skills_percentage skills_css"></span>
                                </div>
                            </div>
                            <div class="skills_data">
                                <div class="skills_titles">
                                    <h3 class="skills_name">JavaScript</h3>
                                    <span class="skills_number">75%</span>
                                </div>
                                <div class="skills_bar">
                                    <span class="skills_percentage skills_js"></span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="overview_skills">
                            <div class="overview_skills-title">
                                <h3>Backend developer</h3>
                            </div>
                            <div class="skills_data">
                                <div class="skills_titles">
                                    <h3 class="skills_name">PHP</h3>
                                    <span class="skills_number">90%</span>
                                </div>
                                <div class="skills_bar">
                                    <span class="skills_percentage skills_html"></span>
                                </div>
                            </div>
                            <div class="skills_data">
                                <div class="skills_titles">
                                    <h3 class="skills_name">Node Js</h3>
                                    <span class="skills_number">80%</span>
                                </div>
                                <div class="skills_bar">
                                    <span class="skills_percentage skills_css"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overview_right">
                        <!-- TOP CARDS -->
                        <div class="overview_cards">
                            <div class="overview_cards-item">
                                <div class="overview_data">
                                    <p>Tìm người ở ghép</p>
                                    <span>1</span>
                                </div>
                                <div class="overview_link">
                                    <span></span>
                                    <a href="#">Xem thông tin</a>
                                </div>
                            </div>
                            <div class="overview_cards-item">
                                <div class="overview_data">
                                    <p>Liên hệ</p>
                                    <span>5</span>
                                </div>
                                <div class="overview_link">
                                    <span></span>
                                    <a href="#">Xem thông tin</a>
                                </div>
                            </div>
                            <div class="overview_cards-item">
                                <div class="overview_data">
                                    <p>Thành viên</p>
                                    <span>10</span>
                                </div>
                                <div class="overview_link">
                                    <span></span>
                                    <a href="#">Xem thông tin</a>
                                </div>
                            </div>
                            <div class="overview_cards-item">
                                <div class="overview_data">
                                    <p>Tin tức</p>
                                    <span>10</span>
                                </div>
                                <div class="overview_link">
                                    <span></span>
                                    <a href="#">Xem thông tin</a>
                                </div>
                            </div>
                            <div class="overview_cards-item">
                                <div class="overview_data">
                                    <p>Đăng tin</p>
                                    <span>11</span>
                                </div>
                                <div class="overview_link">
                                    <span></span>
                                    <a href="#">Thông tin</a>
                                </div>
                            </div>
                        </div>
                        <!-- MEDIUM CARDS -->
                        
                    </div>
                </section>

			
		</main>
		<!-- MAIN -->
	</section>
</template>

<script>

    import sidebarVue from '../layout/sidebar.vue'
    import headerVue from '../layout/header.vue';
    export default{
        components:{
            sidebarVue,headerVue
        }
    }
</script>