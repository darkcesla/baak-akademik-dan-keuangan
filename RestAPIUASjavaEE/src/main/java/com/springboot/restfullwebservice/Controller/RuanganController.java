package com.springboot.restfullwebservice.Controller;

import java.time.LocalDateTime;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestHeader;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import io.jsonwebtoken.Claims;

import com.springboot.restfullwebservice.JwtUtil;
import com.springboot.restfullwebservice.Enitity.BookingRuangan;
import com.springboot.restfullwebservice.Enitity.LoginResponse;
import com.springboot.restfullwebservice.Enitity.Ruangan;
import com.springboot.restfullwebservice.Enitity.Surat;
import com.springboot.restfullwebservice.Enitity.User;
import com.springboot.restfullwebservice.service.BookingRuanganService;
import com.springboot.restfullwebservice.service.RuanganService;
import com.springboot.restfullwebservice.service.UserService;

import org.springframework.http.HttpHeaders;
import org.springframework.web.context.request.RequestContextHolder;
import org.springframework.web.context.request.ServletRequestAttributes;


@RestController
@RequestMapping("/api/ruangan")
public class RuanganController {

    @Autowired
    private RuanganService ruanganService;
    
    @Autowired
    private UserService userService;
    
    @Autowired
    private BookingRuanganService bookingservice;

    @Autowired
    private JwtUtil jwtUtil;

    @PostMapping("/add")
    public ResponseEntity<?> create(@RequestBody Ruangan ruang ,@RequestHeader("Authorization") String token) {
    	User user;
        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
            Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            user = userService.findUserByUsername(username);
            user.setToken(jwtToken);
            if (user.getRoles().toString().equals("Admin")) {
            	Ruangan create_ruangan = ruanganService.createRuangan(ruang);
                return new ResponseEntity<>(create_ruangan, HttpStatus.CREATED);
            }
            else {
            	Map<String, String> error = new HashMap<>();
                error.put("error", "Your Not Admin");
                return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);           
                }
           }
  
    @GetMapping("/all")
    public ResponseEntity<?> getAllBuilds(@RequestHeader("Authorization") String token) {
        if (token == null || !token.startsWith("Bearer ")) {
            Map<String, String> error = new HashMap<>();
            error.put("error", "Your Expired Done");
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
        }

        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "

        try {
            Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            User user = userService.findUserByUsername(username);
            user.setToken(jwtToken);
            List<Ruangan> ruanganList = ruanganService.getAllRuangans();

            for (Ruangan ruangan : ruanganList) {
                List<BookingRuangan> bookings = bookingservice.getBookingByRuanganId(ruangan.getId());
                for (BookingRuangan booking : bookings) {
                    if (booking != null) {
                        if (LocalDateTime.now().isAfter(booking.getOdate()) && booking.getStatus().equals("Approve") && booking.getOdate().isBefore(booking.getCdate())) {
                            ruanganService.RuanganChangeStatus(ruangan.getId(), "Sedang Digunakan");
                        }
                        if(LocalDateTime.now().isAfter(booking.getCdate())) {
                            ruanganService.RuanganChangeStatus(ruangan.getId(), "Available");
                        }
                    }
                }
            }
            return ResponseEntity.ok(ruanganList);
            
        } catch (Exception e) {
            Map<String, String> error = new HashMap<>();
            error.put("error", "Your Expired Done");
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
        }
    }
    @GetMapping("/get/{id}")
    public ResponseEntity<?> getRuanganById(@PathVariable Long id, @RequestHeader("Authorization") String token) {
        if (token == null || !token.startsWith("Bearer ")) {
            Map<String, String> error = new HashMap<>();
            error.put("error", "Your Expired Done");
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
        }

        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "

        try {
            Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            User user = userService.findUserByUsername(username);
            user.setToken(jwtToken);
            
            Ruangan ruangan = ruanganService.getRuanganById(id);
            if (ruangan != null) {
                return ResponseEntity.ok(ruangan);
            } else {
                return ResponseEntity.notFound().build();
            }
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).build();
        }
    }

    
    @DeleteMapping("delete/{id}")
    public ResponseEntity<?> deleteRuangan(@PathVariable Long id, @RequestHeader("Authorization") String token) {
    	  if (token == null || !token.startsWith("Bearer ")) {
              Map<String, String> error = new HashMap<>();
              error.put("error", "Your Expired Done");
              return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
          }
          String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
        try {
        	 Claims claims = jwtUtil.extractAllClaims(jwtToken);
             String username = claims.getSubject();
             User user = userService.findUserByUsername(username);
             user.setToken(jwtToken);
            Ruangan ruangan = ruanganService.getRuanganById(id);
            if (ruangan != null) {
                ruanganService.deleteRuangan(id);
                Map<String, String> succes = new HashMap<>();
                succes.put("succes", "Ruangan Berhasil Dihapus");
                return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(succes);     
                } else {
                return ResponseEntity.notFound().build();
            }
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).build();
        }
    }
    @PutMapping("edit/{id}")
    public ResponseEntity<?> updateRuangan(@PathVariable Long id, @RequestBody Ruangan updatedRuangan, @RequestHeader("Authorization") String token) {
    	 if (token == null || !token.startsWith("Bearer ")) {
             Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Done");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
         }
         String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
       try {
       	 Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            User user = userService.findUserByUsername(username);
            user.setToken(jwtToken);
            Ruangan ruangan = ruanganService.getRuanganById(id);
            if (ruangan != null) {
                Ruangan updated = ruanganService.editRuangan(id, updatedRuangan);
                if (updated != null) {
                    return ResponseEntity.ok(updated);
                } else {
                    return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).build();
                }
            } else {
                return ResponseEntity.notFound().build();
            }
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).build();
        }
    }


    

    



}
