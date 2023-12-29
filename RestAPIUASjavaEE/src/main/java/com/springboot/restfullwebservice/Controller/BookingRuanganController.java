package com.springboot.restfullwebservice.Controller;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import com.springboot.restfullwebservice.JwtUtil;
import com.springboot.restfullwebservice.Enitity.BookingRuangan;
import com.springboot.restfullwebservice.Enitity.LoginResponse;
import com.springboot.restfullwebservice.Enitity.Ruangan;
import com.springboot.restfullwebservice.Enitity.User;
import com.springboot.restfullwebservice.service.BookingRuanganService;
import com.springboot.restfullwebservice.service.RuanganService;
import com.springboot.restfullwebservice.service.UserService;

import io.jsonwebtoken.Claims;

import java.time.LocalDateTime;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("api/booking")
public class BookingRuanganController {

    private final BookingRuanganService bookingRuanganService;

    @Autowired
    private RuanganService ruanganService;
    @Autowired
    private UserService userService;

    @Autowired
    private JwtUtil jwtUtil;
    
    @Autowired
    public BookingRuanganController(BookingRuanganService bookingRuanganService) {
        this.bookingRuanganService = bookingRuanganService;
    }

    @PostMapping("/add")
    public ResponseEntity<?> createBookingRuangan(@RequestBody BookingRuangan bookingRuangan, @RequestHeader("Authorization") String token) {
        User user;
        Ruangan ruang;
        Ruangan idruang;

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
            idruang = bookingRuangan.getRuangan();
            ruang = ruanganService.getRuanganById(idruang.getId());


             List<BookingRuangan> bookings = bookingRuanganService.getBookingByRuanganId(idruang.getId());
                 for (BookingRuangan booking : bookings) {
                   if (booking != null && booking.getStatus().equals("Approve")) {
                      if (bookingRuangan.getOdate().isBefore(booking.getCdate()) && bookingRuangan.getCdate().isAfter(booking.getOdate())) {
                       Map<String, String> error = new HashMap<>();
                       error.put("failed", "Ruangan Telah Di booking Pada Waktu Request");
                       return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
                  }
                }
            } 

            // Jika tidak ada tabrakan waktu yang disetujui, buat pemesanan baru
            bookingRuangan.setUser(user);
            bookingRuangan.setRuangan(ruang);
            bookingRuangan.setStatus("Pending");
            BookingRuangan createdBooking = bookingRuanganService.createBookingRuangan(bookingRuangan);
            return new ResponseEntity<>(createdBooking, HttpStatus.CREATED);

        } catch (IllegalArgumentException ex) {
            return new ResponseEntity<>(ex.getMessage(), HttpStatus.BAD_REQUEST);
        }
    }

    @PutMapping("/changestatus/{id}")
    public ResponseEntity<?> changeBookingStatus(@PathVariable Long id, @RequestBody BookingRuangan updatedBookingRuangan) {
        BookingRuangan updatedBooking = bookingRuanganService.ChangeStatus(id, updatedBookingRuangan);

        if (updatedBooking != null) {
            return ResponseEntity.ok(updatedBooking);
        } else {
            return ResponseEntity.notFound().build();
        }
    }


    @GetMapping("/all")
    public ResponseEntity<?> getAllBookingRuangan(@RequestHeader("Authorization") String token) {
        List<BookingRuangan> allBookings = bookingRuanganService.getAllBookingRuangan();
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
            user.setToken(jwtToken);
            LoginResponse response = new LoginResponse(user);
            if (user.getRoles().toString().equals("Admin")) {
            return new ResponseEntity<>(allBookings, HttpStatus.OK);
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
    public ResponseEntity<?> getAllBookingRuanganUser(@RequestHeader("Authorization") String token) {
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
            user.setToken(jwtToken);
            LoginResponse response = new LoginResponse(user);
            
            List<BookingRuangan> allBookings = bookingRuanganService.getBookingByUser(user.getId());

            return new ResponseEntity<>(allBookings, HttpStatus.OK);
        } catch (Exception e) {
        	 Map<String, String> error = new HashMap<>();
             error.put("error", "Your Expired Done");
             return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error); 
        }
    }

    @GetMapping("/{id}")
    public ResponseEntity<BookingRuangan> getBookingRuanganById(@PathVariable Long id) {
        BookingRuangan booking = bookingRuanganService.getBookingRuanganById(id);
        if (booking != null) {
            return new ResponseEntity<>(booking, HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> updateBookingRuangan(@PathVariable Long id, @RequestBody BookingRuangan updatedBookingRuangan) {
        try {
            BookingRuangan updatedBooking = bookingRuanganService.updateBookingRuangan(id, updatedBookingRuangan);
            if (updatedBooking != null) {
                return new ResponseEntity<>(updatedBooking, HttpStatus.OK);
            } else {
                return new ResponseEntity<>(HttpStatus.NOT_FOUND);
            }
        } catch (IllegalArgumentException ex) {
            return new ResponseEntity<>(ex.getMessage(), HttpStatus.BAD_REQUEST);
        }
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> deleteBookingRuanganById(@PathVariable Long id) {
        bookingRuanganService.deleteBookingRuanganById(id);
        return new ResponseEntity<>("Booking dengan ID " + id + " berhasil dihapus.", HttpStatus.OK);
    }
}
