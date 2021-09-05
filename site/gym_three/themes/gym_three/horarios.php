<!-- Page_Banner Start -->
<section class="breadcrumb_sec">
    <div class="blog_txt">
        <h1 class="wow fadeInUp animated title_animate"> Horários </h1>
        <p class="wow fadeInUp animated titlep_animate"> Home <i class="fa fa-angle-right"></i> Horários</p>
    </div>
</section>
<!-- Page_Banner End -->

<!-- TimeTable Start -->
<div class="timetable_sec inner_page">
    <div class="container">
        <div class="row">
            <ul class="filter-tabs clearfix anim-3-all wow fadeInUp animated day_tabs" id="filter-tabs"
                data-wow-delay="0ms" data-wow-duration="1000ms">
                <li class="filter active" data-filter=".Monday" onclick="filterSelection('Monday')">
                    <span class="btn-txt">Segunda</span>
                </li>
                <li class="filter" data-filter=".tuesday" onclick="filterSelection('tuesday')">
                    <span class="btn-txt">Terça</span>
                </li>
                <li class="filter" data-filter=".Wednesday" onclick="filterSelection('Wednesday')">
                    <span class="btn-txt">Quarta</span>
                </li>
                <li class="filter" data-filter=".Thursday" onclick="filterSelection('Thursday')">
                    <span class="btn-txt">Quinta</span>
                </li>
                <li class="filter" data-filter=".Friday" onclick="filterSelection('Friday')">
                    <span class="btn-txt">Sexta</span>
                </li>
                <li class="filter" data-filter=".Saturday" onclick="filterSelection('Saturday')">
                    <span class="btn-txt">Sábado</span>
                </li>
                <li class="filter" data-filter=".sunday" onclick="filterSelection('sunday')">
                    <span class="btn-txt">Domingo</span>
                </li>
            </ul>
            <select class="select filter-tabs clearfix wow fadeInUp animated select_day"
                    onchange="filterSelection(this.value)" data-wow-delay="0ms" data-wow-duration="1000ms">
                <option value="Monday">Segunda</option>
                <option value="tuesday">Terça</option>
                <option value="Wednesday">Quarta</option>
                <option value="Thursday">Quinta</option>
                <option value="Friday">Sexta</option>
                <option value="Saturday">Sábado</option>
                <option value="sunday">Domingo</option>
            </select>
            <div class="projects-container filter-list clearfix wow fadeInUp animated col-sm-12 col-xs-12 col-md-12"
                 data-wow-delay="300ms" data-wow-duration="1000ms">
                <div class="row">
                    <article class="project-box wow col-md-3 col-sm-4 col-xs-6 hvr-rectangle-out">
                        <div class="Monday mix_all Saturday text-content">
                            <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/size.png" alt=""><br>
                            <span class="time"> 06:00 - 08:00 </span>
                            <h4> Weight Loose </h4>
                            <p> Rachel Adam </p>
                        </div>
                    </article>
                    <article class="project-box wow col-md-3 col-sm-4 col-xs-6 hvr-rectangle-out">
                        <div class="Monday mix_all Thursday sunday tuesday text-content">
                            <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/run.png" alt=""> <br>
                            <span class="time"> 08:00 - 10:00 </span>
                            <h4> Cardio </h4>
                            <p> Rachel Adam </p>
                        </div>
                    </article>
                    <article class="project-box wow col-md-3 col-sm-4 col-xs-6 hvr-rectangle-out">
                        <div class="Monday mix_all Friday text-content">
                            <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/yoga.png" alt=""><br>
                            <span class="time"> 10:00 - 12:00 </span>
                            <h4> Ioga </h4>
                            <p> Lefew D. Loee </p>
                        </div>
                    </article>
                    <article class="project-box wow col-md-3 col-sm-4 col-xs-6 hvr-rectangle-out right-line_hide">
                        <div class="text-content Monday mix_all  tuesday Wednesday sundays ">
                            <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/body.png" alt=""> <br>
                            <span class="time"> 12:00 - 14:00 </span>
                            <h4> Fitness </h4>
                            <p> Rachel Adam </p>
                        </div>
                    </article>
                    <article class="project-box wow col-md-3 col-sm-4 col-xs-6 hvr-rectangle-out bottomrow">
                        <div class=" Monday mix_all  tuesday text-content">
                            <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/box.png" alt=""> <br>
                            <span class="time"> 14:00 - 16:00 </span>
                            <h4> Karatê </h4>
                            <p> Keaf Shen </p>
                        </div>
                    </article>
                    <article class="project-box wow col-md-3 col-sm-4 col-xs-6 hvr-rectangle-out bottomrow">
                        <div class=" Monday mix_all Thursday Saturday Friday tuesday text-content">
                            <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/boxing-gloves.png" alt=""> <br>
                            <span class="time"> 16:00 - 18:00 </span>
                            <h4> Boxing </h4>
                            <p> Rachel Adam </p>
                        </div>
                    </article>
                    <article class="project-box wow col-md-3 col-sm-4 col-xs-6 hvr-rectangle-out bottomrow">
                        <div class="Monday mix_all Thursday Saturday sundays text-content">
                            <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/rope.png" alt=""> <br>
                            <span class="time"> 18:00 - 20:00 </span>
                            <h4> Aerobics & Skipping </h4>
                            <p> Lefew D. Loee </p>
                        </div>
                    </article>
                    <article
                        class="project-box wow col-md-3 col-sm-3 col-xs-6 hvr-rectangle-out right-line_hide bottomrow">
                        <div class="Monday mix_all Saturday Friday Wednesday tuesday sundays text-content show">
                            <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/biceps.png" alt=""> <br>
                            <span class="time"> 20:00 - 22:00 </span>
                            <h4>Body Building </h4>
                            <p> Rachel Adam </p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- TimeTable End -->

<!-- Call_To_Action Start -->
<section class="call_to_action">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="call_to_action_con">
                    <h1>Aulas Especiais Para o Verão, <br><span class="color_change">35% de Desconto!</span></h1>
                    <p>Nunc malesuada, odio sit amet aliquam pulvinar, justo lectus auctor nisl, vitae volutpat erat
                        arcu sit amet tellus. In sodales metus sed varius lobortis.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="call_to_action_btn">
                    <a href="<?= BASE; ?>/contato" class="action_btn" title="Saber Mais">Saber Mais</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Call_To_Action End -->
