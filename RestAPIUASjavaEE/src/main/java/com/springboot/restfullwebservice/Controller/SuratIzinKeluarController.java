package com.springboot.restfullwebservice.Controller;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import com.springboot.restfullwebservice.JwtUtil;
import com.springboot.restfullwebservice.Enitity.LoginResponse;
import com.springboot.restfullwebservice.Enitity.Surat;
import com.springboot.restfullwebservice.Enitity.SuratIzinKeluar;
import com.springboot.restfullwebservice.Enitity.User;
import com.springboot.restfullwebservice.service.SuratIzinKeluarService;
import com.springboot.restfullwebservice.service.SuratService;
import com.springboot.restfullwebservice.service.UserService;

import io.jsonwebtoken.Claims;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/api/izinkeluar")
public class SuratIzinKeluarController {

    @Autowired
    private SuratIzinKeluarService suratIzinKeluarService;

    @Autowired
    private UserService userService;

    @Autowired
    private JwtUtil jwtUtil;


    @PostMapping("/add")
    public ResponseEntity<?> createSuratIzinKeluar(@RequestBody SuratIzinKeluar suratIzinKeluar,@RequestHeader("Authorization") String token) {
        
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
             suratIzinKeluar.setUser(user);
             SuratIzinKeluar createdSurat = suratIzinKeluarService.createSuratIzinKeluar(suratIzinKeluar);
             return new ResponseEntity<>(createdSurat, HttpStatus.CREATED);
         } catch (Exception e) {
        	 Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Done");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
        }
    }

    @GetMapping("/all")
    public ResponseEntity<?> getAllSuratIzinKeluar(@RequestHeader("Authorization") String token) {
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
              LoginResponse response = new LoginResponse(user);
              if (user.getRoles().toString().equals("Admin")) {
            	  List<SuratIzinKeluar> suratIzinKeluarList = suratIzinKeluarService.getAllSuratIzinKeluar();
                  return new ResponseEntity<>(suratIzinKeluarList, HttpStatus.OK);              }
              else {
              	 Map<String, String> error = new HashMap<>();
                   error.put("error", "Your Not Admin");
                   return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
              }
          } catch (Exception e) {
          	 Map<String, String> error = new HashMap<>();
               error.put("error", "Your Expired Done");
               return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
          }   
    }
    
    @GetMapping("/alls")
    public ResponseEntity<?> getAllSuratKeluarnUser(@RequestHeader("Authorization") String token) {
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
            LoginResponse response = new LoginResponse(user);
            
            List<SuratIzinKeluar> surat = suratIzinKeluarService.getSuratIzinKeluarByUser(user.getId());

            return new ResponseEntity<>(surat,HttpStatus.OK);
        } catch (Exception e) {
        	 Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Done");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
        }
    }

    @GetMapping("/{id}")
    public ResponseEntity<SuratIzinKeluar> getSuratIzinKeluarById(@PathVariable("id") Long id) {
        SuratIzinKeluar suratIzinKeluar = suratIzinKeluarService.getSuratIzinKeluarById(id);
        if (suratIzinKeluar != null) {
            return new ResponseEntity<>(suratIzinKeluar, HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @PutMapping("/{id}/update")
    public ResponseEntity<SuratIzinKeluar> updateSuratIzinKeluar(@PathVariable("id") Long id, @RequestBody SuratIzinKeluar updatedSuratIzinKeluar) {
       
    	
    	
    	SuratIzinKeluar updatedSurat = suratIzinKeluarService.updateSuratIzinKeluar(id, updatedSuratIzinKeluar);
        if (updatedSurat != null) {
            return new ResponseEntity<>(updatedSurat, HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @PutMapping("/changestatus/{id}")
    public ResponseEntity<SuratIzinKeluar> changeStatus(@PathVariable("id") Long id, @RequestBody SuratIzinKeluar status) {
        SuratIzinKeluar changedStatusSurat = suratIzinKeluarService.changeStatus(id, status);
        if (changedStatusSurat != null) {
            return new ResponseEntity<>(changedStatusSurat, HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @DeleteMapping("/{id}/delete")
    public ResponseEntity<Void> deleteSuratIzinKeluarById(@PathVariable("id") Long id) {
        suratIzinKeluarService.deleteSuratIzinKeluarById(id);
        return new ResponseEntity<>(HttpStatus.NO_CONTENT);
    }
}
