<script setup>

import { onMounted, onUnmounted, ref } from "vue";
import { OrbitControls } from "three/examples/jsm/controls/OrbitControls";
import * as THREE from "three";
import * as dat from "dat.gui";
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader';


import stars from '../image/background-image.jpg';
import tuong from '../image/tuong.jpg';
import them from '../image/them.jpg';
import cuaso from '../image/cuaso.jpg';

let canvasRef = ref();

const renderer = new THREE.WebGLRenderer();

renderer.setSize(window.innerWidth, window.innerHeight);

document.body.appendChild(renderer.domElement);

let scene = new THREE.Scene();

let camera = new THREE.PerspectiveCamera(75,window.innerWidth / window.innerHeight,0.1,1000);


const orbit = new OrbitControls(camera, renderer.domElement);

const axesHelper = new THREE.AxesHelper(5);
scene.add(axesHelper);

camera.position.set(10, 50, 30);
orbit.update();

let boxGeometry = new THREE.BoxGeometry(20.20);
let boxMaterial = new THREE.MeshStandardMaterial( {color: 0xffffff  });
let box = new THREE.Mesh(boxGeometry, boxMaterial);

scene.add(box);

let planeGeometry = new THREE.PlaneGeometry(30, 30);
let planeMaterial = new THREE.MeshStandardMaterial( {
  color: 0xffffff,
});
let plane = new THREE.Mesh(planeGeometry, planeMaterial);
scene.add(plane);
plane.rotation.x = -0.5 * Math.PI;


let sphereGeometry = new THREE.BoxGeometry(1,20,30);
let sphereMaterial = new THREE.MeshStandardMaterial( {color: 0x00ffef ,  wireframe: false });
let sphere = new THREE.Mesh(sphereGeometry, sphereMaterial);
scene.add(sphere);

sphere.position.set(14.5, 10, 0)




 const ambientLight = new THREE.AmbientLight(0xffffff);
 scene.add(ambientLight);

const directionalLight = new THREE.DirectionalLight(0xffffff);
scene.add(directionalLight);

const textureLoader = new THREE.TextureLoader();
scene.background = textureLoader.load(stars);
// const cubeTextureLoader = new THREE.CubeTextureLoader();
// scene.background = cubeTextureLoader.load([
//      stars
// ]);
let box2Geometry = new THREE.BoxGeometry(30,20);
let box2Material = new THREE.MeshStandardMaterial( {
  color: 0xffffff,  
});
let box2 = new THREE.Mesh(box2Geometry, box2Material);
scene.add(box2);

box2.position.set(0,10, 15)

let box3Geometry = new THREE.BoxGeometry(30,20);
let box3Material = new THREE.MeshStandardMaterial( {
  color: 0xeeffee,  
});

let box3 = new THREE.Mesh(box3Geometry, box3Material);
scene.add(box3);

box3.position.set(0,10, -15)

const loader = new GLTFLoader();

loader.load( '../image/kitchen_furniture.glb', function ( gltf ) {

	scene.add( gltf.scene );
  renderer.render(scene, camera);
}, undefined, function ( error ) {

	console.error( error );

} );


const gridHelper = new THREE.GridHelper(30);

scene.add(gridHelper);

const  gui = new dat.GUI();

const options = {
   sphereColor: "#ffffff",
   wireframe: false,
};


gui.addColor(options, 'sphereColor').onChange(function(e){
  sphere.material.color.set(e);
  box2.material.color.set(e);
  box3.material.color.set(e);
});

gui.add(options, 'wireframe').onChange(function(e){
  sphere.material.wireframe = e;
});

let step = 0;
let speed = 0.01;

function animate(time) {
  box.rotation.x = time / 1000;
  box.rotation.y = time / 1000;
  step += speed;
  // sphere.position.y  = 10 * Math.abs(Math.sin(step)); 

  renderer.render(scene, camera);
}
renderer.setAnimationLoop(animate);

</script>

<template>
  <div class="development" >
    <canvas ref="canvasRef" ></canvas>
  </div>
</template>
