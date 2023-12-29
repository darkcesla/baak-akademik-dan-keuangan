package com.springboot.restfullwebservice.Controller;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import com.springboot.restfullwebservice.JwtUtil;
import com.springboot.restfullwebservice.Enitity.LoginResponse;
import com.springboot.restfullwebservice.Enitity.Surat;
import com.springboot.restfullwebservice.Enitity.SuratIzinBermalam;
import com.springboot.restfullwebservice.Enitity.SuratIzinKeluar;
import com.springboot.restfullwebservice.Enitity.User;
import com.springboot.restfullwebservice.service.SuratIzinBermalamService;
import com.springboot.restfullwebservice.service.SuratService;
import com.springboot.restfullwebservice.service.UserService;

import io.jsonwebtoken.Claims;

import java.time.DayOfWeek;
import java.time.LocalDateTime;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/api/izinbermalam")
public class SuratIzinBermalamController {

    @Autowired
    private SuratIzinBermalamService suratIzinBermalamService;

    @Autowired
    private UserService userService;

    @Autowired
    private JwtUtil jwtUtil;


    @PostMapping("/add")
    public ResponseEntity<?> createSuratIzinBermalam(@RequestBody SuratIzinBermalam suratIzinBermalam, @RequestHeader("Authorization") String token) {
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
            suratIzinBermalam.setUser(user);

            // Mendapatkan waktu saat ini
            LocalDateTime currentTime = suratIzinBermalam.getWaktuBerangkat();
            // Validasi waktu berangkat sesuai kriteria (Jumat pukul 17.00, Sabtu 08.00 - 17.00)
            DayOfWeek dayOfWeek = currentTime.getDayOfWeek();
            int hour = currentTime.getHour();

            if ((dayOfWeek == DayOfWeek.FRIDAY && (hour >= 17 )) ||
                (dayOfWeek == DayOfWeek.SATURDAY && (hour >= 8 && hour <= 17))) {
                SuratIzinBermalam createdSurat = suratIzinBermalamService.createSuratIzinBermalam(suratIzinBermalam);
                return new ResponseEntity<>(createdSurat, HttpStatus.CREATED);
            }
            else{
                Map<String, String> error = new HashMap<>();
                error.put("failed", "Gagal Request IB, Pastikan Waktu Berangkat Anda di hari Jumat di jam 17.00-23.59 dan hari Sabtu di jam 08.00 - 17.00");
                return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(error);
            }
         
        } catch (Exception e) {
            Map<String, String> error = new HashMap<>();
            error.put("error", "Your Expired Done");
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
        }
    }


    @GetMapping("/all")
    public ResponseEntity<?> getAllSuratIzinBermalam(@RequestHeader("Authorization") String token) {
    	
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
                  List<SuratIzinBermalam> suratIzinBermalamList = suratIzinBermalamService.getAllSuratIzinBermalam();
                  return new ResponseEntity<>(suratIzinBermalamList, HttpStatus.OK);
              }
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
    public ResponseEntity<?> getAllSuratBermalamnUser(@RequestHeader("Authorization") String token) {
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
            
            List<SuratIzinBermalam> surat = suratIzinBermalamService.getSuratIzinBermalamByUser(user.getId());

            return new ResponseEntity<>(surat,HttpStatus.OK);
        } catch (Exception e) {
        	 Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Done");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
        }
    }

    @GetMapping("get/{id}")
    public ResponseEntity<SuratIzinBermalam> getSuratIzinBermalamById(@PathVariable("id") Long id) {
        SuratIzinBermalam suratIzinBermalam = suratIzinBermalamService.getSuratIzinBermalamById(id);
        if (suratIzinBermalam != null) {
            return new ResponseEntity<>(suratIzinBermalam, HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @PutMapping("/{id}/update")
    public ResponseEntity<SuratIzinBermalam> updateSuratIzinBermalam(@PathVariable("id") Long id, @RequestBody SuratIzinBermalam updatedSuratIzinBermalam) {
       
    	
    	
    	SuratIzinBermalam updatedSurat = suratIzinBermalamService.updateSuratIzinBermalam(id, updatedSuratIzinBermalam);
        if (updatedSurat != null) {
            return new ResponseEntity<>(updatedSurat, HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @PutMapping("/changestatus/{id}")
    public ResponseEntity<SuratIzinBermalam> changeStatus(@PathVariable("id") Long id, @RequestBody SuratIzinBermalam status) {
        SuratIzinBermalam changedStatusSurat = suratIzinBermalamService.changeStatus(id, status);
        if (changedStatusSurat != null) {
            return new ResponseEntity<>(changedStatusSurat, HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @DeleteMapping("/{id}/delete")
    public ResponseEntity<Void> deleteSuratIzinBermalamById(@PathVariable("id") Long id) {
        suratIzinBermalamService.deleteSuratIzinBermalamById(id);
        return new ResponseEntity<>(HttpStatus.NO_CONTENT);
    }
}
