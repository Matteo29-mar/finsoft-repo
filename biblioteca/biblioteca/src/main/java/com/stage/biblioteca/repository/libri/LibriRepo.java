package com.stage.biblioteca.repository.libri;

import com.stage.biblioteca.dto.libri.LibriDto;
import com.stage.biblioteca.entity.libri.Libri;
import lombok.NonNull;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.repository.PagingAndSortingRepository;

import java.util.List;
import java.util.Optional;


public interface LibriRepo extends JpaRepository<Libri, Integer> {

}
