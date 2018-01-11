@extends('backend.layouts.main-no-container')

@section('title', 'Lori')

@section('header')
    @include('backend.components.header')
@endsection

@section('topper')
    <div class="ui sixteen wide column top-bar">
        <div class="ui two column grid">
        </div>
    </div>
@endsection


@section('content')

    <style>
    .node {

        top: 0;
        left: 0;

        position: absolute;
        width: 200px;
        box-shadow: 1px 2px 7px rgba(0, 0, 0, 0.3);
        border-radius: 5px;

        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .node.dragging {
        z-index: 101;
    }
    .node-header {
        display: block;
        padding: 10px;
        color: #fff;
        text-shadow: 1px 1px rgba(0, 0, 0, 0.25);
        font-weight: bold;
        border-radius: 5px 5px 0 0;
        cursor: pointer;
        -webkit-user-drag: none;
    }

    .node.question .node-header {
        border-bottom: 1px solid #0a7424;
        background: #168422;
        background: -moz-linear-gradient(top, #0a7424 0%, #168422 100%);
        background: -webkit-linear-gradient(top, #0a7424 0%,#168422 100%);
        background: linear-gradient(to bottom, #0a7424 0%,#168422 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0a7424', endColorstr='#168422',GradientType=0 );
    }

    .node.answer .node-header {
        border-bottom: 1px solid #0b5dc5;
        background: #0f65c0;
        background: -moz-linear-gradient(top, #0659c3 0%, #0f65c0 100%);
        background: -webkit-linear-gradient(top, #0659c3 0%,#0f65c0 100%);
        background: linear-gradient(to bottom, #0659c3 0%,#0f65c0 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0659c3', endColorstr='#0f65c0',GradientType=0 );
    }

    .node-content {
        position: relative;
        color: #fff;
        text-shadow: 1px 1px rgba(0, 0, 0, 0.25);
        display: block;
        padding: 10px;
        border-radius: 0 0 5px 5px;
    }

    .node.answer .node-content {
        background: #35c728;
        background: -moz-linear-gradient(top, #157ff0 0%, #39abe5 100%);
        background: -webkit-linear-gradient(top, #157ff0 0%,#39abe5 100%);
        background: linear-gradient(to bottom, #157ff0 0%,#39abe5 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#157ff0', endColorstr='#39abe5',GradientType=0 );
    }

    .node.question .node-content {
        background: #35c728;
        background: -moz-linear-gradient(top, #1da72a 0%, #35c728 100%);
        background: -webkit-linear-gradient(top, #1da72a 0%,#35c728 100%);
        background: linear-gradient(to bottom, #1da72a 0%,#35c728 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1da72a', endColorstr='#35c728',GradientType=0 );
    }

    .node-point {
        position: absolute;
        top: -8px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #fff;
        border: 1px solid #d9d9d9;
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
    }
    .node-point.parent {
        left: -8px;
    }
    .node-point.children {
        right: -8px;
    }




        #test {
            margin: 0;
            padding: 0;
            position: relative;
        }
        .row {
            position: absolute;
            display: block;
            background: red;
             width:20px;
            height:20px;
        }


        #vue-app {
            margin: 0;
            padding: 0;
            position: relative;
        }

        .vc-context-menu {
            position: absolute;
            z-index: 100;
            display: inline-block;
            min-width: 13em;
            max-width: 26em;
            background: #fff;
            border: 1px solid #bebebe;
            border-radius: .2em;
            -webkit-box-shadow: 0 2px 5px rgba(0, 0, 0, .5);
            box-shadow: 0 2px 5px rgba(0, 0, 0, .5);
        }
        .vc-context-menu ul {
            list-style-type: none;
            margin: 10px 0;
            padding: 0;
        }
        .vc-context-menu ul li {
            position: relative;
            padding: .4em 2em;
            color: #2f2f2f;
            background-color: #fff;
            cursor: pointer;
        }
        .vc-context-menu ul li:hover {
            color: #fff;
            background-color: #1c7f99;
        }



    </style>




    <template id="vc-context-menu">
        <div class="vc-context-menu" :style="'top:' + settings.top + 'px;' + 'left:' + settings.left + 'px;'" >
            <ul>
                <li @click="addQuestion">Add Question</li>
                <li @click="addAnswer">Add Answer</li>
            </ul>
        </div>
    </template>

    <template id="vc-canvas">
        <svg width=1500 height=1000 @contextmenu.prevent="openRightClickMenu"></svg>
    </template>

    <template id="vc-node">
        <div class="node" :class="[node.settings.type == 'question' ? 'question' : 'answer', moving ? 'dragging' : '']"  :style="position">
            <div class="node-header" @mousedown="startDrag" @mousemove="drag" @mouseup="stopDrag" @mouseout="stopDrag">
                @{{node.settings.type}}
            </div>
            <div class="node-content">
                <div class="node-point parent" data-node-type="0" data-type="0" data-id="1"></div>
                <div class="node-point children" data-node-type="0" data-type="1" data-id="1" data-connected="2"></div>
                content
            </div>
        </div>
    </template>



    <div id="vue-app">
        <vc-context-menu v-if="contextMenu.visible" :settings="contextMenu.settings"></vc-context-menu>
        <vc-canvas></vc-canvas>
        <vc-node v-for="node in nodes" :node="node" v-bind:ref="'node' + node.id"></vc-node>
    </div>


    <script type="text/javascript" src="https://unpkg.com/vue@2.2.6"></script>
    <script type="text/javascript" src="{{ asset('js/visual-composer.js') }}"></script>




{{--     <div id="test">

        <div class="node question">
            <div class="node-header">
                Question
            </div>
            <div class="node-content">
                <div class="node-point parent" data-node-type="0" data-type="0" data-id="1"></div>
                <div class="node-point children" data-node-type="0" data-type="1" data-id="1" data-connected="2"></div>
                content
            </div>
        </div>

        <div class="node answer" style="left:600px; top:220px">
            <div class="node-header">
                Answer
            </div>
            <div class="node-content">
                <div class="node-point parent" data-node-type="1" data-type="0" data-id="2" data-connected="1"></div>
                <div class="node-point children" data-node-type="1" data-type="1" data-id="2"></div>
                content
            </div>
        </div>
    </div> --}}











    <script>
        var RELATION_SPACING  = 15;
        var relations = [];
        // var point1 = document.getElementById("row1");
        // var point2 = document.getElementById("row2");

        var Gparent1, Gparent2;

        var currentPoint = null;

        var moving = false;

        var color = "#000";
        var dom = document.getElementById("test");

    $(document).ready(function() {


        // var svgNS = "http://www.w3.org/2000/svg";
        // var svg = document.createElementNS(svgNS, "svg");
        // dom.svg = svg;
        // dom.svg.setAttribute('width', "1500px")
        // dom.svg.setAttribute('height', "1500px")
        // dom.appendChild(svg);


        // $('.node-point').each(function(){

        //     if($(this).data('connected') && !$(this).data('line')){

        //         var path = document.createElementNS(svgNS, "path");
        //         path.setAttribute("stroke", color);
        //         path.setAttribute("stroke-width", 2);
        //         path.setAttribute("fill", "none");
        //         dom.svg.appendChild(path);
        //         relations.push(path);

        //         var connectedTo = $(this).data('connected');
        //         var point1 = $(this)[0];
        //         var parent1 = $(this).parents('.node')[0];
        //         var point2 = $(".node-point[data-id='" + connectedTo +"']")[0];
        //         var parent2 = $(".node-point[data-id='" + connectedTo +"']").parents('.node')[0];
        //         // redraw(parent1, parent2);
        //         point1.setAttribute('data-line', true);
        //         point2.setAttribute('data-line', true);
        //     }
        // })

        $(".node-point").click(function(){

            // if not connected start drawing line to cursor
            // on second click check if another node is being edited and connect it to it (if conditions are true)
            // if second click target is not a point delete path
            // if it is connect the points
            //
            //




            // if($(this).data('connected'){

            // }
            //     if(moving) {
            //         console.log(1);
            //         moving = false;
            //         currentPoint = null;
            //     } else {
            //         console.log(2);
            //         moving = true;
            //         currentPoint = $(this);
            //     }
        })


        $(".node-header").click(function(){
                if(moving) {
                    moving = false;
                    currentNode = null;
                } else {
                    moving = true;
                    currentNode = $(this).parents('.node');

                    var connectedTo = currentNode.find('.node-point[data-line="true"]').data('connected');
                    Gparent1 = currentNode[0];
                    var Gpoint2 = $(".node-point[data-id='" + connectedTo +"']")[0];
                    Gparent2 = $(".node-point[data-id='" + connectedTo +"']").parents('.node')[0];
                }
        })

        Math.clip = function(number, min, max) {
            return Math.max(min, Math.min(number, max));
        }

        // var canvas = $("#test")[0];
        // var rect =  canvas.getBoundingClientRect();
        // var maxXPercentage = (canvas.clientWidth - 20) / canvas.clientWidth * 100;
        // var maxYPercentage = (canvas.clientHeight - 20) / canvas.clientHeight * 100;

        $("#test").mousemove(function(event) {
            if (moving == true) {
                var x = (((event.clientX - rect.left - 15) / (canvas.clientWidth)) * 100);
                var y = (((event.clientY - rect.top - 15) / (canvas.clientHeight)) * 100);
                if(!isNaN(x) && !isNaN(y)){
                    movePoint(x, y)
                }
            }

        });

        function movePoint(x, y) {
            if (moving == true) {
                currentNode.css({
                    'top': y + '%',
                    'left': x + '%'
                })
                redraw(Gparent1,Gparent2);
            }
        }

    });





        redrawNormal = function(p1, p2, half) {
            if (dom.svg) {
                var str = "M "+p1[0]+" "+p1[1]+" C "+(p1[0] + half)+" "+p1[1]+" ";
                str += (p2[0]-half)+" "+p2[1]+" "+p2[0]+" "+p2[1];
                this.relations[0].setAttribute("d",str);
            } else {
                this.relations[0].style.left = p1[0]+"px";
                this.relations[0].style.top = p1[1]+"px";
                this.relations[0].style.width = half+"px";

                this.relations[1].style.left = (p1[0] + half) + "px";
                this.relations[1].style.top = Math.min(p1[1],p2[1]) + "px";
                this.relations[1].style.height = (Math.abs(p1[1] - p2[1])+RELATION_THICKNESS)+"px";

                this.relations[2].style.left = (p1[0]+half+1)+"px";
                this.relations[2].style.top = p2[1]+"px";
                this.relations[2].style.width = half+"px";
            }
        }

        redrawSide = function(p1, p2, x) {
            // if already has vector
            // if (this.owner.vector) {
                var str = "M "+p1[0]+" "+p1[1]+" C "+x+" "+p1[1]+" ";
                str += x+" "+p2[1]+" "+p2[0]+" "+p2[1];
                this.relations[0].setAttribute("d",str);
            // } else {
                // this.relations[0].style.left = Math.min(x,p1[0])+"px";
                // this.relations[0].style.top = p1[1]+"px";
                // this.relations[0].style.width = Math.abs(p1[0]-x)+"px";

                // this.relations[1].style.left = x+"px";
                // this.relations[1].style.top = Math.min(p1[1],p2[1]) + "px";
                // this.relations[1].style.height = (Math.abs(p1[1] - p2[1]) + RELATION_THICKNESS)+"px";

                // this.relations[2].style.left = Math.min(x,p2[0])+"px";
                // this.relations[2].style.top = p2[1]+"px";
                // this.relations[2].style.width = Math.abs(p2[0]-x)+"px";
            // }
        }



        redraw = function(point1, point2) {

            var t1 = point1;
            var t2 = point2;
            var l1 = t1.offsetLeft;
            var l2 = t2.offsetLeft;
            var r1 = l1 + t1.offsetWidth;
            var r2 = l2 + t2.offsetWidth;
            var t1 = t1.offsetTop + Math.round(t1.offsetHeight/2);
            var t2 = t2.offsetTop + Math.round(t2.offsetHeight/2);

        //  if (this.row1.owner.selected) { t1++; l1++; r1--; }
        //  if (this.row2.owner.selected) { t2++; l2++; r2--; }
        //   t1++; l1++; r1--;
        //   t2++; l2++; r2--;

            var p1 = [0,0];
            var p2 = [0,0];

            // if (r1 < l2 || r2 < l1) { /* between tables */

                if (Math.abs(r1 - l2) < Math.abs(r2 - l1)) {
                    p1 = [r1,t1];
                    p2 = [l2,t2];
                } else {
                    p1 = [r2,t2];
                    p2 = [l1,t1];
                }
                var half = Math.floor((p2[0] - p1[0])/2);
                this.redrawNormal(p1, p2, half);

            // } else { /* next to tables */
            //     var x = 0;
            //     var l = 0;
            //     if (Math.abs(l1 - l2) < Math.abs(r1 - r2)) { /* left of tables */
            //         p1 = [l1,t1];
            //         p2 = [l2,t2];
            //         x = Math.min(l1,l2) - RELATION_SPACING;
            //     } else { /* right of tables */
            //         p1 = [r1,t1];
            //         p2 = [r2,t2];
            //         x = Math.max(r1,r2) + RELATION_SPACING;
            //     }
            //     this.redrawSide(p1, p2, x);
            // } /* line next to tables */
        }












        // var color = "#000";
        // var dom = document.getElementById("test");

        // var svgNS = "http://www.w3.org/2000/svg";
        // var svg = document.createElementNS(svgNS, "svg");
        // dom.svg = svg;
        // dom.svg.setAttribute('width', "1500px")
        // dom.svg.setAttribute('height', "1500px")
        // dom.appendChild(svg);


        // var path = document.createElementNS(svgNS, "path");
        // path.setAttribute("stroke", color);
        // path.setAttribute("stroke-width", 2);
        // path.setAttribute("fill", "none");
        // dom.svg.appendChild(path);
        // relations.push(path);

        // var point1 = document.getElementById("row1");
        // var point2 = document.getElementById("row2");



        // redraw(point1, point2);
    </script>


@endsection