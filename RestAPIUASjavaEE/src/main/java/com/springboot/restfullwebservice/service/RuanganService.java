package com.springboot.restfullwebservice.service;

import org.springframework.beans.factory.annotation.Autowired;

import com.springboot.restfullwebservice.Enitity.Ruangan;
import com.springboot.restfullwebservice.repository.RuanganRepository;
import org.springframework.stereotype.Service;
import org.springframework.web.bind.annotation.RequestBody;

import java.util.List;

@Service
public class RuanganService {

    @Autowired
    private RuanganRepository RuanganRepository;

    public List<Ruangan> getAllRuangans() {
        return RuanganRepository.findAll();
    }

    public Ruangan getRuanganById(long id) {
        return RuanganRepository.findById(id).orElse(null);
    }

    public Ruangan createRuangan(Ruangan Ruangan) {
    	Ruangan.setStatus_ruangan("Available");
        return RuanganRepository.save(Ruangan);
    }

    public Ruangan editRuangan(long id,@RequestBody Ruangan updated_ruangan) {
        Ruangan existingRuangan = RuanganRepository.findById(id).orElse(null);
        if (existingRuangan != null) {
        	existingRuangan.setNama_ruangan(updated_ruangan.getNama_ruangan());
        	existingRuangan.setKapasitas(updated_ruangan.getKapasitas());
        	return RuanganRepository.save(existingRuangan);
        } else {
            return null;
        }
    }
    public Ruangan RuanganChangeStatus(long id , String status) {
        Ruangan existingRuangan = RuanganRepository.findById(id).orElse(null);
        if (existingRuangan != null) {
        	existingRuangan.setStatus_ruangan(status);
        	return RuanganRepository.save(existingRuangan);
        } else {
            return null;
        }

    }
    public void deleteRuangan(Long id) {
        Ruangan existingRuangan = RuanganRepository.findById(id).orElse(null);
        if (existingRuangan != null) {
            RuanganRepository.delete(existingRuangan);
        }
    }
}
