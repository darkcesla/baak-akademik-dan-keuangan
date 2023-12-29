package com.springboot.restfullwebservice.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import com.springboot.restfullwebservice.JwtUtil;
import com.springboot.restfullwebservice.Enitity.BookingRuangan;
import com.springboot.restfullwebservice.Enitity.Kaos;
import com.springboot.restfullwebservice.Enitity.PaymentKaos;
import com.springboot.restfullwebservice.Enitity.Ruangan;
import com.springboot.restfullwebservice.Enitity.User;
import com.springboot.restfullwebservice.service.KaosService;
import com.springboot.restfullwebservice.service.PaymentKaosService;
import com.springboot.restfullwebservice.service.UserService;

import io.jsonwebtoken.Claims;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/api/paymentkaos")
public class PaymentKaosController {

    @Autowired
    private PaymentKaosService paymentKaosService;
    
    @Autowired
    private UserService userService;

    @Autowired
    private JwtUtil jwtUtil;
    
    @Autowired
    private KaosService kaosService;



    @PostMapping("/add")
    public ResponseEntity<?> createPaymentKaos(@RequestBody PaymentKaos paymentKaos , @RequestHeader("Authorization") String token) {
    	  User user;

          if (token == null || !token.startsWith("Bearer ")) {
              Map<String, String> error = new HashMap<>();
              error.put("error", "Your Expired Done");
              return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
          }

          String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "

          try {
              Claims claims = jwtUtil.extractAllClaims(jwtToken);
              String username = claims.getSubject();
              user = userService.findUserByUsername(username);
              
              Kaos idkaos = paymentKaos.getKaos();
              Kaos kaos = kaosService.getKaosById(idkaos.getId());
              if(kaos.getHarga() == paymentKaos.getNominal_pembayaran()) {
              paymentKaos.setKaos(kaos);
              paymentKaos.setuser(user);
              PaymentKaos createdPayment = paymentKaosService.createPaymentKaos(paymentKaos);
              return new ResponseEntity<>(createdPayment, HttpStatus.CREATED);
              }
              else {
            	  Map<String, String> error = new HashMap<>();
                  error.put("failed", "Harga Nominal Pembayaran harus sama dengan harga kaos");
                  return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
              }
          } catch (IllegalArgumentException ex) {
              return new ResponseEntity<>(ex.getMessage(), HttpStatus.BAD_REQUEST);
          }
    }

    @GetMapping("/all")
    public ResponseEntity<?> getAllPaymentKaos(@RequestHeader("Authorization") String token) {
    	 User user;

         if (token == null || !token.startsWith("Bearer ")) {
             Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Dond");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
         }

         String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "

         try {
             Claims claims = jwtUtil.extractAllClaims(jwtToken);
             String username = claims.getSubject();
             user = userService.findUserByUsername(username);
             if (user.getRoles().toString().equals("Admin")) {
            	   List<PaymentKaos> allPayments = paymentKaosService.getAllPaymentKaos();
                   return new ResponseEntity<>(allPayments, HttpStatus.OK);
                 }
                 else {
                 	 Map<String, String> error = new HashMap<>();
                      error.put("error", "Your Not Admin");
                      return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
                 }
          
             
           
         } catch (IllegalArgumentException ex) {
             return new ResponseEntity<>(ex.getMessage(), HttpStatus.BAD_REQUEST);
         }
    
    }

    @GetMapping("/alls")
    public ResponseEntity<?> getPaymentByUserId(@RequestHeader("Authorization") String token) {
    	 User user;

         if (token == null || !token.startsWith("Bearer ")) {
             Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Done");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
         }

         String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "

         try {
             Claims claims = jwtUtil.extractAllClaims(jwtToken);
             String username = claims.getSubject();
             user = userService.findUserByUsername(username);
             List<PaymentKaos> paymentsByUser = paymentKaosService.getPaymentByUserId(user.getId());
             return new ResponseEntity<>(paymentsByUser, HttpStatus.OK);
             
           
         } catch (IllegalArgumentException ex) {
             return new ResponseEntity<>(ex.getMessage(), HttpStatus.BAD_REQUEST);
         }
    	
       
    }


}
