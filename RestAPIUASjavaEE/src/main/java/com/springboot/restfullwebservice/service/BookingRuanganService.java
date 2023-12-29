package com.springboot.restfullwebservice.service;

import org.springframework.stereotype.Service;

import com.springboot.restfullwebservice.Enitity.BookingRuangan;
import com.springboot.restfullwebservice.Enitity.Ruangan;
import com.springboot.restfullwebservice.repository.BookingRuanganRepository;

import java.time.LocalDateTime;
import java.util.Collections;
import java.util.Comparator;
import java.util.List;

@Service
public class BookingRuanganService {

    private final BookingRuanganRepository bookingRuanganRepository;

    // Inject BookingRuanganRepository using constructor
    public BookingRuanganService(BookingRuanganRepository bookingRuanganRepository) {
        this.bookingRuanganRepository = bookingRuanganRepository;
    }

    public BookingRuangan createBookingRuangan(BookingRuangan bookingRuangan) {
        LocalDateTime Odate = bookingRuangan.getOdate();
        LocalDateTime Cdate = bookingRuangan.getCdate();

        if (Odate != null && Cdate != null && Odate.isBefore(Cdate)) {
        	bookingRuangan.setStatus("Pending");
            return bookingRuanganRepository.save(bookingRuangan);
        } else {
            throw new IllegalArgumentException("Odate harus lebih kecil dari Cdate");
        }
    }

    public List<BookingRuangan> getAllBookingRuangan() {
        List<BookingRuangan> bookingRuanganList = bookingRuanganRepository.findAll();
        Comparator<BookingRuangan> comparator = Comparator.comparing(BookingRuangan::getOdate);
        Collections.sort(bookingRuanganList, comparator);
        return bookingRuanganList;
    }
    public BookingRuangan getBookingRuanganById(long id) {
        return bookingRuanganRepository.findById(id).orElse(null);
    }
    public List<BookingRuangan> getBookingByUser(Long userId) {
    	List<BookingRuangan> bookingRuanganList = bookingRuanganRepository.findByUserId(userId);
    	Comparator<BookingRuangan> comparator = Comparator.comparing(BookingRuangan::getId);
        Collections.sort(bookingRuanganList,Collections.reverseOrder(comparator));
        return bookingRuanganList;
       

    }
    public List<BookingRuangan> getBookingByRuanganId(Long ruanganId) {
        return bookingRuanganRepository.findByRuanganId(ruanganId);
    }


    public void deleteBookingRuanganById(Long id) {
        bookingRuanganRepository.deleteById(id);
    }

    public BookingRuangan updateBookingRuangan(Long id, BookingRuangan updatedBookingRuangan) {
        BookingRuangan existingBookingRuangan = bookingRuanganRepository.findById(id).orElse(null);

        if (existingBookingRuangan != null) {
            LocalDateTime Odate = updatedBookingRuangan.getOdate();
            LocalDateTime Cdate = updatedBookingRuangan.getCdate();

            if (Odate != null && Cdate != null && Odate.isBefore(Cdate)) {
                existingBookingRuangan.setRuangan(updatedBookingRuangan.getRuangan());
                existingBookingRuangan.setUser(updatedBookingRuangan.getUser());
                existingBookingRuangan.setOdate(updatedBookingRuangan.getOdate());
                existingBookingRuangan.setCdate(updatedBookingRuangan.getCdate());
                return bookingRuanganRepository.save(existingBookingRuangan);
            } else {
                throw new IllegalArgumentException("Odate harus lebih kecil dari Cdate");
            }
        } else {
            return null;
        }
    }
    public BookingRuangan ChangeStatus(Long id, BookingRuangan updatedBookingRuangan) {
        BookingRuangan existingBookingRuangan = bookingRuanganRepository.findById(id).orElse(null);

        if (existingBookingRuangan != null) {
            existingBookingRuangan.setStatus(updatedBookingRuangan.getStatus());
           return bookingRuanganRepository.save(existingBookingRuangan);
        }
           else {
            return null;
        }
    }
}
