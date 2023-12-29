package com.springboot.restfullwebservice.repository;
import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.springboot.restfullwebservice.Enitity.BookingRuangan;

@Repository
public interface BookingRuanganRepository extends JpaRepository<BookingRuangan, Long> {
    List<BookingRuangan> findByUserId(Long userId);
    List<BookingRuangan> findByRuanganId(Long ruanganId);
}
