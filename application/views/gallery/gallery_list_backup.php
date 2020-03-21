<?php echo $header; ?>
<style>
    .container_events {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
      flex-wrap: wrap;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  /*width: 80vw;*/
  margin: auto;
}
.container_events h1 {
  -webkit-box-flex: 0;
      -ms-flex: none;
          flex: none;
  width: 100%;
  margin: 0 2% 2em 2%;
}

.cardList {
  position: relative;
  display: block;
  -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
          flex: 1 1 auto;
  margin: 2%;
  -webkit-filter: none;
          filter: none;
  opacity: 1;
  -webkit-transition: 0.25s ease-in-out opacity, 0.25s ease-in-out filter;
  transition: 0.25s ease-in-out opacity, 0.25s ease-in-out filter;
  cursor: pointer;
}
.cardList__title {
  display: block;
  padding-top: 70%;
  text-align: center;
  font-size: 0.8em;
  opacity: 0.8;
  z-index: 0;
}
.cardList:hover .card {
  box-shadow: 0 5px 25px 0 rgba(0, 0, 0, 0.5);
  -webkit-transition: 0.35s ease-out transform, 0.35s ease-out shadow;
  transition: 0.35s ease-out transform, 0.35s ease-out shadow;
}
.cardList:nth-child(2n + 1) .card:nth-child(1) {
  -webkit-transform: translate(-2%, -2%);
          transform: translate(-2%, -2%);
}
.cardList:nth-child(2n + 1) .card:nth-child(2) {
  -webkit-transform: translate(-2%, 2%) rotate(2deg);
          transform: translate(-2%, 2%) rotate(2deg);
}
.cardList:nth-child(2n + 1) .card:last-of-type {
  -webkit-transform: rotate(-2deg);
          transform: rotate(-2deg);
}
.cardList:nth-child(2n + 1):hover .card__bg {
  -webkit-filter: none;
          filter: none;
  opacity: 1;
}
.cardList:nth-child(2n + 1):hover .card:nth-child(1) {
  -webkit-transform: translate(30%, 45%) rotate(-2deg);
          transform: translate(30%, 45%) rotate(-2deg);
}
.cardList:nth-child(2n + 1):hover .card:nth-child(2) {
  -webkit-transform: translate(-50%, 35%) rotate(5deg);
          transform: translate(-50%, 35%) rotate(5deg);
}
.cardList:nth-child(2n + 1):hover .card:last-of-type {
  -webkit-transform: rotate(5deg) translate(0%, -40%);
          transform: rotate(5deg) translate(0%, -40%);
}
.cardList:nth-child(2n) .card:nth-child(1) {
  -webkit-transform: translate(2%, 2%);
          transform: translate(2%, 2%);
}
.cardList:nth-child(2n) .card:nth-child(2) {
  -webkit-transform: translate(2%, -2%) rotate(-2deg);
          transform: translate(2%, -2%) rotate(-2deg);
}
.cardList:nth-child(2n) .card:nth-child(3) {
  -webkit-transform: rotate(2deg);
          transform: rotate(2deg);
}
.cardList:nth-child(2n):hover .card:nth-child(1) {
  -webkit-transform: translate(2%, 50%) rotate(5deg);
          transform: translate(2%, 50%) rotate(5deg);
}
.cardList:nth-child(2n):hover .card:nth-child(2) {
  -webkit-transform: translate(50%, -30%) rotate(10deg);
          transform: translate(50%, -30%) rotate(10deg);
}
.cardList:nth-child(2n):hover .card:nth-child(3) {
  -webkit-transform: translate(-25%, -40%) rotate(-5deg);
          transform: translate(-25%, -40%) rotate(-5deg);
}

.card {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  padding-top: 60%;
  background-color: #ccc;
  -webkit-transition: 0.28s ease-out transform, 0.28s ease-out shadow;
  transition: 0.28s ease-out transform, 0.28s ease-out shadow;
  overflow: hidden;
  z-index: 5;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.2);
}
.card__bg {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-repeat: no-repeat;
  background-size: cover;
  background-color: #ccc;
}
.card:not(:last-of-type) .card__bg {
  background-blend-mode: multiply;
  -webkit-filter: grayscale(100%);
          filter: grayscale(100%);
  opacity: 0.25;
  -webkit-transition: 0.25s ease-in-out filter, 0.25s ease-in-out opacity;
  transition: 0.25s ease-in-out filter, 0.25s ease-in-out opacity;
}
.cardList:hover .card:not(:last-of-type) .card__bg {
  background-blend-mode: normal;
  -webkit-filter: none;
          filter: none;
  opacity: 1;
}

.container_events:hover .cardList {
  -webkit-filter: grayscale(100%);
          filter: grayscale(100%);
  opacity: 0.25;
  z-index: 1;
}
.container_events:hover .cardList:hover {
  -webkit-filter: none;
          filter: none;
  opacity: 1;
  z-index: 100;
}

</style>
<!-- Content Content Area Start -->
<div class="col-md-10">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron text-center">
                <h1 class="service_title">Gallery List</h1>
                <p class="sub_title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc auctor leo efficitur nibh egestas, at imperdiet est venenatis.
                    Vivamus maximus odio in ante dignissim, eu blandit turpis sodales.
                    Nullam in facilisis erat. Maecenas placerat justo sed dolor sodales pharetra. Morbi lobortis efficitur sem, et ullamcorper elit molestie ut
                </p>
            </div>
            <div class="container_events">
                <h1>Gallery</h1>
                    <?php
                        if(isset($galleries) && !empty($galleries)){
                            foreach($galleries as $gallery){ ?>
                            <div class="cardList">
                                <?php foreach ($gallery['gallery_data'] as $gallery_data) {
                                    ?>
                                    <div class="card">
                                        <a href="<?php echo base_url('welcome/gallery_details/'.$gallery['gallery']->id) ?>">
                                            <div class="card__bg" style="background-image: url(<?php echo base_url('images/exhibition/' . $gallery_data->image_path); ?>);"></div>
                                        </a>
                                    </div>
                                <?php } ?>
                                <span class="cardList__title"><?php echo $gallery['gallery']->title; ?></span>
                            </div>
                    <?php
                            }
                        }
                    ?>
            </div>
        </div>
    </div>
</div>
<!-- Content Content Area End -->
<?php echo $footer; ?>